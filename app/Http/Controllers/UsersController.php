<?php

namespace App\Http\Controllers;

use App\Code;
use App\Mail\ContactMail;
use App\User;
use App\Round;
use App\League;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Notifications\LeagueInviteNotification;
use TCG\Voyager\Models\Page;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $rounds = Round::orderBy('name')->get();
        $leagues = auth()->user()->leagues;

        return view('users.show', compact('user','rounds','leagues'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $redirect = request()->get('redirect', '/pronosticos');
        if($redirect == '/users/'.$user->id)$redirect = '/pronosticos';
        $this->validate(request(), [
           'city' => 'required'
        ]);
        $user->update(request()->all());
        return redirect($redirect);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Ranking data by page
     * @param int $page
     * @return array
     */
    public function ranking($page = 1)
    {
        $league = request()->get('league', 0);
        $round = request()->get('round', 0);
        $results = [];
        if($league){
            $lg = League::find($league);
            $users = $lg->users()->orderByDesc('points')->get();
        } else {
            $users = User::orderByDesc('points')->get();
        }
        $results['pagination']['total'] = $users->count();
        $results['pagination']['page'] = $page;
        $results['pagination']['items'] = 10;
        $results['pagination']['prev'] = ($page > 1 ? $page - 1 : null);
        $results['pagination']['pages'] = ceil($results['pagination']['total'] / $results['pagination']['items']);
        $results['pagination']['next'] = ($page < $results['pagination']['pages'] ? $page + 1 : null);
        if ($round) {
            $rnd = Round::find($round);
            foreach ($users as $key => $user) {
                $users[$key]->points = $user->predictions()->whereHas('match', function ($query) use ($round) {
                    $query->where('round_id', $round);
                })->get()->sum('points');
            }
            $users = array_sort($users, function ($value) {
                return -(100 * $value->points);
            });
            $newusers = [];
            foreach ($users as $user) {
                $newusers[] = $user;
            }
            $newusers = collect($newusers);
            $newusers = $newusers->forPage($page, 10);
        } else {
            $newusers = $users->forPage($page, 10);
        }
        $results['users'] = $newusers;
        return $results;
    }

    /**
     * Creates a new league
     */
    public function createLeague()
    {
        $this->validate(request(), [
            'name'        => 'required|min:3',
            'description' => 'required|min:3',
            'code'        => 'required|min:5|alpha_num|unique:leagues',
        ]);
        // ['required','min:5',Rule::unique('leagues')->ignore($user->id),]
        $results = [];
        $league = auth()->user()->myleagues()->create(request()->all());
        auth()->user()->leagues()->detach($league->id);
        auth()->user()->leagues()->attach($league->id);
        $results['id'] = $league->id;
        $results['status'] = 'success';
        $results['message'] = 'Liga creada correctamente!';
        return $results;
    }

    public function deleteLeague(League $league)
    {
        $results = [];
        $this->authorize('delete', $league);
        $league->delete();
        $results['status'] = 'success';
        $results['message'] = 'Liga eliminada';

        return $results;
    }

    /**
     * Leave league
     * @param League $league
     * @return array
     */
    public function leaveLeague(League $league)
    {
        $results = [];
        $league->users()->detach(auth()->user()->id);
        $results['status'] = 'success';
        $results['message'] = 'Has abandonado la liga';

        return $results;
    }

    /**
     * Join league
     * @return array
     */
    public function joinLeague()
    {
        $results = [];
        if ($code = request()->get('code')) {
            if ($league = League::where('code', $code)->first()) {
                $league->users()->detach(auth()->user()->id);
                $league->users()->attach(auth()->user()->id);
                $results['status'] = 'success';
                $results['message'] = 'Te has unido a la liga';
            } else {
                $results['status'] = 'error';
                $results['message'] = 'No se encontró una liga con ese código!';
            }
        } else {
            $results['status'] = 'error';
            $results['message'] = 'No se encontró una liga!';
        }
        return $results;
    }

    /**
     * Invite users to given league
     * @param League $league
     * @return array
     */
    public function inviteLeague(League $league)
    {
        $results = [];
        $errors  = [];
        $success = [];
        $list = request()->get('list');
        $list = str_replace('\r\n', ',', $list);
        $list = str_replace('\n', ',', $list);
        $list = str_replace('\r', ',', $list);
        $list = str_replace(' ', '', $list);
        $list = str_replace('
', ',', $list);
        if ($list != "") {
            $emails  = explode(',', $list);
            foreach ($emails as $email) {
                $email     = strtolower(trim($email));
                $validator = Validator::make(['email' => $email], [
                    'email' => 'required|email',
                ]);
                if ($validator->fails()) {
                    $errors[] = $email;
                } else {
                    $success[] = $email;
                    $password = false;
                    if (!($us = User::where('email', $email)->first())) {
                        $name = substr($email, 0, strpos($email, '@'));
                        $password = $name . rand(1000,9999);
                        $us = User::create([
                            'email' => $email,
                            'name' => $name,
                            'password' => bcrypt($password)
                        ]);
                    }
//                    $us->leagues()->detach($league->id);
//                    $us->leagues()->attach($league->id);
                    $us->notify(new LeagueInviteNotification($league, $password));
                }
            }
        }
        $results['errors'] = $errors;
        $results['success'] = $success;
        $results['status'] = 'success';
        $results['message'] = count($success) . ' invitaciones enviadas';
        return $results;
    }

    /**
     * Updates league data
     * @param League $league
     * @return array
     */
    public function updateLeague(League $league)
    {
        $this->authorize('update', $league);
        $league->update(request()->all());
        $results = [];
        $results['status'] = 'success';
        $results['message'] = 'Información actualizada';

        return $results;
    }

    /**
     * Displays user account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account()
    {
        $user = auth()->user();
        $rounds = Round::orderBy('name')->get();
        $leagues = auth()->user()->leagues;

        return view('users.account', compact('user','rounds','leagues'));
    }

    /**
     * Updates user password
     */
    public function updatePassword()
    {
        $this->validate(request(),[
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user =auth()->user();
        $user->password = bcrypt(request()->get('password'));
        $user->save();
        $results = [];
        $results['status']  = 'success';
        $results['message']  = 'Contraseña actualizada';

        return $results;

    }

    /**
     * Apply code to user
     * @return array
     */
    public function applyCode()
    {
        $this->validate(request(),[
            'code'=>'required|size:5|alpha_num|exists:codes',
            'round'=>'required'
        ]);
        $round_id = request()->get('round');
        $round = Round::find($round_id);
        $this->authorize('applycode',$round);
        $results = [];
        $code = Code::where('code',request()->get('code'))->first();
        if($code->applied){
            $results['error'] = true;
            $results['code']  = ['Este código ya ha sido usado'];
        } else {

            $code->user()->associate(auth()->user());
            $code->round()->associate($round_id);
            $code->applied = Carbon::now();
            $code->save();

            $matches = $round->matches;
            foreach($matches as $match){
                $match->calculatePoints();
            }
            $results['message'] = 'Código aplicado correctamente!';
            $results['status'] = 'success';
        }
        return $results;
    }

    /**
     * Show update city page
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCity()
    {
        $redirect = session('redirect','pronosticos');
        $page = Page::firstOrCreate(['slug'=>'actualizar-ciudad'],['title'=>'Actualizar Ciudad']);
        $user = auth()->user();
        return view('users/update-city',compact('page', 'user', 'redirect'));
    }

}
