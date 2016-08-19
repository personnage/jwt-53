<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class JWTController extends ApiController
{
    /**
     * Create a new token controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => [
            'payload'
        ]]);

        $this->middleware('jwt.refresh', ['only' => [
            'refresh'
        ]]);
    }

    /**
     * Get the raw payload.
     *
     * @return array
     */
    public function payload(Request $request)
    {
        $payload = JWTAuth::parseToken()->getPayload()->toArray();

        return $this->respond(compact('payload'));
    }

    /**
     * Refresh an expired token.
     * @deprecated use
     * @return string
     */
    // public function forceRefresh(Request $request)
    // {
    //     try {
    //        $token = JWTAuth::parseToken()->refresh();
    //     } catch (TokenInvalidException $e) {
    //         // 400
    //         return $this->setStatusCode($e->getStatusCode())
    //             ->respondWithError('Could not decode token')
    //         ;
    //     } catch (TokenExpiredException $e) {
    //         // 401
    //         return $this->setStatusCode($e->getStatusCode())
    //             ->respondWithError('Token has expired and can no longer be refreshed')
    //         ;
    //     } catch (JWTException $e) {
    //         // 500
    //         return $this->setStatusCode($e->getStatusCode())
    //             ->respondWithError('The token could not be parsed from the request')
    //         ;
    //     }

    //     return $this->respond(compact('token'));
    // }

    /**
     * Refresh an expired token.
     *
     * @return null
     */
    public function refresh()
    {
        return $this->respond(['ok' => true]);
    }
}
