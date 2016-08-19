<?php

/*
|--------------------------------------------------------------------------
| JWT Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['namespace' => 'Auth'], function () {
    Route::post('join', 'JWTRegisterController@register');
    Route::post('login', 'JWTLoginController@login');
});

Route::group(['prefix' => 'token'], function() {
    Route::get('payload', 'JWTController@payload');
    Route::post('refresh', 'JwtController@refresh');
});


