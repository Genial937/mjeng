<?php

    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

//    Route::group(['prefix' => 'auth','middleware' => 'log.route'], function () {
//        Route::post('login', 'Api\V1\JwtAuthenticateController@authenticate');
//        Route::get('refresh', 'Api\V1\JwtAuthenticateController@refresh');
//        Route::get('me', 'Api\V1\JwtAuthenticateController@me');
//        Route::get('logout', 'Api\V1\JwtAuthenticateController@logout');
//        Route::post('change-password', 'Api\V1\JwtAuthenticateController@assistedChangePassword');
//    });
//    Route::group(['prefix' => 'admin', 'middleware' => 'log.route', ['ability:admin,create-users']], function () {
//        Route::post('role', 'Api\V1\JwtAuthenticateController@createRole');
//        Route::post('permission', 'Api\V1\JwtAuthenticateController@createPermission');
//        Route::get('roles', 'Api\V1\JwtAuthenticateController@roles');
//        Route::get('permissions', 'Api\V1\JwtAuthenticateController@permissions');
//        Route::post('attach-permission', 'Api\V1\JwtAuthenticateController@attachPermission');
//        Route::post('assign-role', 'Api\V1\JwtAuthenticateController@assignRole');
//        Route::post('user', 'Api\V1\JwtAuthenticateController@createUser');
//        Route::patch('user', 'Api\V1\JwtAuthenticateController@updateUser');
//        Route::get('user/{user_id}', 'Api\V1\JwtAuthenticateController@find');
//        Route::get('users', 'Api\V1\JwtAuthenticateController@index');
//        Route::post('change-user-password', 'Api\V1\JwtAuthenticateController@changePassword');
//    });
//
//




