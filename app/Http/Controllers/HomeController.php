<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
        $selected_round = $rounds->first();
        return view('game',compact('rounds','selected_round'));
    }
}
