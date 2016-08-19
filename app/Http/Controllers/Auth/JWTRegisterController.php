<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Requests\AuthJoinRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\RegistersUsers;

class JWTRegisterController extends ApiController
{
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  AuthJoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthJoinRequest $request)
    {
        $this->create($request->all());

         return $this->setStatusCode(201)->respond(['ok' => true]);
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
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
