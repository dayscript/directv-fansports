<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Round;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','redirectToProvider', 'handleProviderCallback']);
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $selected_round = Round::getNearestRound();
        $ranking = User::orderByDesc('points')->take(10)->get();
        return view('auth.login',compact('selected_round', 'ranking'));
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
//            ->scopes(['email', 'user_friends','name'])
            ->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        if ($user && $user->getEmail()) {
            if (auth()->check() && ( auth()->user()->email == $user->getEmail() )) {
                $us = auth()->user();
            } else {
                $us = User::where('email', $user->getEmail())->first();
                if ($us){
                    auth()->login($us);
                }else {
                    $name = $user->getName();
                    $first = trim(substr($name,0,strpos($name,' ')));
                    $last = trim(str_replace($first,'', $name));
                    $us = User::create(['email' => $user->getEmail(), 'name' => $first,'last'=>$last]);
                    auth()->login($us);
                }
            }
            return redirect()->intended($this->redirectPath());
        } else {
            return redirect('/login');
        }

    }
}
