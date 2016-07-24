<?php

namespace App\Http\Controllers\Auth;

use App\Eloquent\Access;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $appKey = 'qbgoHqxBpLuX8c7BXRTBpKu5qbMbHKBA';

    protected $appSecret = 'ff748e696c051ec06883ce32539667a2ec05dab16d22acb30212fdf0df7eaee1';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'globe']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function globe(Request $request)
    {
        $auth = new \App\Globe\Auth($this->appKey, $this->appSecret);
        if ($code = $request->get('code')) {
            $response = $auth->getAccessToken($request->get('code'));
            if (!($user = Auth::user())->access) {
                $user->access()->create([
                    'token' => $response['access_token'], 
                    'mobile_no' => $response['subscriber_number']
                ]);
            }
            return redirect($this->redirectTo);
        }
        return redirect($auth->getLoginUrl());
    }
}
