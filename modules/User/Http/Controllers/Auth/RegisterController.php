<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\User\Models\User;
use Konekt\Address\Models\PersonProxy;
use Modules\Profile\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Konekt\Customer\Models\Customer;
use Konekt\Customer\Models\CustomerType;
use Modules\Core\Http\Controllers\Controller as BaseController;

class RegisterController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'username' => 'required|string|max:255|unique:users',
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function showRegistrationForm() {
        return view('user::auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = User::create([
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);

        $nameParts = explode(' ', $user->name, 2); // Split into maximum 2 parts

        $firstName = $nameParts[0]; // First name is always the first part

        if (count($nameParts) > 1) {
            $lastName = $nameParts[1]; // Last name is the second part if available
        } else {
            $lastName = $firstName; // Use first name for last name if last name is not available
        }
        $customer = Customer::create([
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'type' => CustomerType::INDIVIDUAL
        ]);

        $user->customer_id = $customer->id;

        $person = PersonProxy::create([
                    'user_id' => $user->id,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
        ]);

        $profile = new Profile([
            'user_id' => $user->id,
            'person_id' => $person->id
        ]);
        $user->profile()->save($profile);

        return $user;
    }

}
