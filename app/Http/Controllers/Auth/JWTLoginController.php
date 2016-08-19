<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Controllers\ApiController;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class JWTLoginController extends ApiController
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  AuthLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $this->credentials($request);

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {

                // Find user by username to send filed event!
                $user = User::where($this->username(), $credentials[$this->username()])
                    ->first()
                ;

                if (! is_null($user)) {
                    $this->fireFailedEvent($user, $credentials);
                }

                return $this->setStatusCode(401)
                    ->respondWithError('These credentials do not match our records')
                ;
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->setStatusCode(500)
                ->respondWithError('Could not create token')
            ;
        }

        // Get user by token.
        $user = JWTAuth::toUser($token);
        $token = JWTAuth::fromUser($user, $user->claims());

        $this->fireLoginEvent($user, $request->has('remember'));

        // all good so return the token
        return $this->respond(compact('token'));
    }

    protected function fireLoginEvent(User $user)
    {
        event(new Login($user, false));
    }

    protected function fireFailedEvent(User $user, array $credentials)
    {
        event(new Failed($user, $credentials));
    }
}
