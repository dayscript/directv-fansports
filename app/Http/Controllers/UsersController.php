<?php

namespace App\Http\Controllers;

use App\Round;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
        $ligue = request()->get('league',0);
        $round = request()->get('round',0);
        $results = [];
        $users = User::orderByDesc('points')->get();
        $results['pagination']['total'] = $users->count();
        $results['pagination']['page'] = $page;
        $results['pagination']['items'] = 10;
        $results['pagination']['prev'] = ($page>1?$page-1:null);
        $results['pagination']['pages'] = ceil($results['pagination']['total']/$results['pagination']['items']);
        $results['pagination']['next'] = ($page<$results['pagination']['pages']?$page+1:null);
        if($round){
            $rnd = Round::find($round);

            foreach($users as $key=>$user){
                $users[$key]->points = $user->predictions()->whereHas('match', function($query)use($round){
                    $query->where('round_id',$round);
                })->get()->sum('points');
            }
            $users = array_sort($users, function ($value) {
                return -(100 * $value->points);
            });
            $newusers = [];
            foreach ($users as $user){
                $newusers[] = $user;
            }
            $newusers = collect($newusers);
            $newusers = $newusers->forPage($page,10);
        } else {
            $newusers = $users->forPage($page,10);
        }
        $results['users'] = $newusers;
        return $results;
    }
}
