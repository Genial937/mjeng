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
// API route group that we need to protect
    Route::post('payment/status/reg', 'Api\V1\MicroServiceController@pokeapay_callback_reg');
    Route::post('payment/status/airtime', 'Api\V1\MicroServiceController@pokeapay_callback_airtime');
    Route::post('payment/status/mpesa', 'Api\V1\MicroServiceController@pokeapay_callback_mpesa');

    Route::group(['prefix' => 'withdraw'], function () {
        Route::post('/status', 'Api\V1\MicroServiceController@pokeapay_callback_withdraw');
        Route::post('/', 'Api\V1\WithdrawController@withdraw');
        Route::post('/charges', 'Api\V1\WithdrawController@charges');
    });

    Route::group(['prefix' => 'sms'], function () {
        Route::post('/send', 'Api\V1\NotifyController@sendSms');
        Route::post('/sendbulk', 'Api\V1\SmsController@sendBulkSms');
    });

    Route::group(['prefix' => 'counties'], function () {
    Route::get('/', 'Api\V1\CountyController@index');
    Route::get('/{name}', 'Api\V1\CountyController@find');
    Route::post('/create', 'Api\V1\CountyController@create');
    });
    Route::group(['prefix' => 'subcounties'], function () {
        Route::post('/create', 'Api\V1\SubCountyController@create');
    });

    Route::group(['prefix' => 'commission'], function () {
        Route::post('/award', 'Api\V1\CashbackController@award');
        Route::post('/award/undo', 'Api\V1\CashbackController@undoAward');
        Route::post('/unwarded', 'Api\V1\CashbackController@unward_payment');
        Route::post('/check/unwarded', 'Api\V1\CashbackController@checkUnAwarded');
    });


    Route::group(['prefix' => 'airtime'], function () {
        Route::post('/buy', 'Api\V1\AirtimeController@buy');
        Route::post('/status', 'Api\V1\MicroServiceController@wigopay_callback_airtime');
        Route::post('/award/comm', 'Api\V1\CashbackController@airtime');

    });

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'Api\V1\JwtAuthenticateController@authenticate');
        Route::get('otp', 'Api\V1\JwtAuthenticateController@sendOtp');
        Route::put('otp', 'Api\V1\JwtAuthenticateController@verifyOtp');
        Route::get('refresh', 'Api\V1\JwtAuthenticateController@refresh');
        Route::get('me', 'Api\V1\JwtAuthenticateController@me');
        Route::get('logout', 'Api\V1\JwtAuthenticateController@logout');
        Route::post('change-password', 'Api\V1\JwtAuthenticateController@assistedChangePassword');
    });
    Route::group(['prefix' => 'admin', 'middleware' => ['ability:admin,create-users']], function () {
        Route::post('role', 'Api\V1\JwtAuthenticateController@createRole');
        Route::post('permission', 'Api\V1\JwtAuthenticateController@createPermission');
        Route::get('roles', 'Api\V1\JwtAuthenticateController@roles');
        Route::get('permissions', 'Api\V1\JwtAuthenticateController@permissions');
        Route::post('attach-permission', 'Api\V1\JwtAuthenticateController@attachPermission');
        Route::post('assign-role', 'Api\V1\JwtAuthenticateController@assignRole');
        Route::post('user', 'Api\V1\JwtAuthenticateController@createUser');
        Route::patch('user', 'Api\V1\JwtAuthenticateController@updateUser');
        Route::get('user/{user_id}', 'Api\V1\JwtAuthenticateController@find');
        Route::get('users', 'Api\V1\JwtAuthenticateController@index');
        Route::post('change-user-password', 'Api\V1\JwtAuthenticateController@changePassword');
        Route::get('users/phone/{phone}', 'Api\V1\JwtAuthenticateController@findUser');
        Route::get('users/rank', 'Api\V1\JwtAuthenticateController@referralRanking');
        Route::post('users/referral/levels', 'Api\V1\JwtAuthenticateController@referralLevels');
    });






