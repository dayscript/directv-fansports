<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('instructions');
    }
    /**
     * Show the application terms and conditions
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        return view('terms');
    }
    /**
     * Show privacy policy
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        return view('privacy');
    }
    /**
     * Show support page
     *
     * @return \Illuminate\Http\Response
     */
    public function support()
    {
        return view('support');
    }
}
