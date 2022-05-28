<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;

use Auth;

use Str;

use Hash;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User();
    }



    public function facebook()
    {
        //send user request to facebook

        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {
        //get oauth facebook request
        $user =  Socialite::driver('facebook')->stateless()->user();

        $new_user = $this->user->firstOrCreate([
            "email" => $user->email,

        ], [
            'name' => $user->name,
            'avatar_url' => $user->avatar,
            'password' => Hash::make(Str::random(24))
        ]);


        Auth::login($new_user, true);

        return redirect('/home');
    }


    public function google()
    {
        //send user request to google

        return Socialite::driver('google')->redirect();
    }


    public function googleRedirect()
    {
        //get oauth facebook request
        $user =  Socialite::driver('google')->stateless()->user();

        $new_user = $this->user->firstOrCreate([
            "email" => $user->email,

        ], [
            'name' => $user->name,
            'avatar_url' => $user->avatar,
            'password' => Hash::make(Str::random(24))
        ]);


        Auth::login($new_user, true);

        return redirect('/home');
    }
}
