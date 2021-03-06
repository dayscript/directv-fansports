<?php

namespace App\Http\Controllers;

use App\League;
use App\Mail\ContactMail;
use App\Round;
use App\User;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Models\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'instructions',
            'terms',
            'privacy',
            'support',
            'contact',
            'premios',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selected_round = Round::getNearestRound();
        $ranking = User::orderByDesc('points')->take(10)->get();
        return view('home',compact('selected_round', 'ranking'));
    }
    /**
     * Show the application instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function instructions()
    {
        $page = Page::firstOrCreate(['slug'=>'como-jugar-fansports'],['title'=>'Cómo jugar Fansports']);
        return view('instructions', compact('page'));
    }
    /**
     * Show the application terms and conditions
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $page = Page::firstOrCreate(['slug'=>'terminos-y-condiciones'],['title'=>'Términos y Condiciones']);
        return view('terms', compact('page'));
    }
    /**
     * Show privacy policy
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $page = Page::firstOrCreate(['slug'=>'politica-de-privacidad'],['title'=>'Política de Privacidad']);
        return view('privacy',compact('page'));
    }
    /**
     * Show premios page
     *
     * @return \Illuminate\Http\Response
     */
    public function premios()
    {
        $page = Page::firstOrCreate(['slug'=>'premios'],['title'=>'Premios']);
        return view('premios',compact('page'));
    }
    /**
     * Show Ligas page
     *
     * @return \Illuminate\Http\Response
     */
    public function ligas()
    {
        $edit_league = null;
        $editable = false;
        if($edit_id = request()->get('edit')){
            $edit_league = League::find($edit_id);
        }
        $join_code = request()->get('join',null);
        $page = Page::firstOrCreate(['slug'=>'ligas'],['title'=>'Ligas']);
        $leagues = auth()->user()->leagues()->withCount('users')->get()->each->append('users_points');
        return view('ligas',compact('page','leagues', 'edit_league','editable','join_code'));
    }
    /**
     * Show Ranking page
     *
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        if( !($l = request()->get('l'))){
            $l = null;
        }
        $rounds = Round::orderBy('name')->get();
        $leagues = auth()->user()->leagues;
        $page = Page::firstOrCreate(['slug'=>'ranking'],['title'=>'Ranking']);
        return view('ranking',compact('page','rounds', 'leagues','l'));
    }
    /**
     * Show support page
     *
     * @return \Illuminate\Http\Response
     */
    public function support()
    {
        $page = Page::firstOrCreate(['slug'=>'soporte'],['title'=>'Soporte']);
        return view('support',compact('page'));
    }
    /**
     * Game page
     *
     * @return \Illuminate\Http\Response
     */
    public function game()
    {
        $rounds = Round::orderBy('name')->get();
        $selected_round = Round::getNearestRound();
        return view('game',compact('rounds','selected_round'));
    }

    /**
     * Mail contact form
     * @return array
     */
    public function contact()
    {
        $this->validate(request(),[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'message'=>'required|min:5',
        ]);
        $data = request()->all();
        Mail::to('jcardenas@dayscript.com')->send(new ContactMail($data));
        $results = [];
        $results['status'] = 'success';
        $results['message'] = 'Información enviada correctamente!';

        return $results;

    }
}
