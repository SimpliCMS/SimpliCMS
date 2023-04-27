<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Modules\User\Models\User;
use Modules\Core\Http\Controllers\Controller;

class SocialLoginController extends Controller {

    protected function _registerOrLoginUser($data) {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }

//Google Login
    public function redirectToGoogle() {
        return Socialite::driver('google')->stateless()->redirect();
    }

//Google callback  
    public function handleGoogleCallback() {

        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

//Facebook Login
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

//facebook callback  
    public function handleFacebookCallback() {

        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

//Github Login
    public function redirectToGithub() {
        return Socialite::driver('github')->stateless()->redirect();
    }

//github callback  
    public function handleGithubCallback() {

        $user = Socialite::driver('github')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

}
