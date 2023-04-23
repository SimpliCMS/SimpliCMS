<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Core\Http\Controllers\Controller as BaseController;

class LoginController extends BaseController {
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('user::auth.login');
    }

    public function redirectTo() {
        return '/';
    }

}
