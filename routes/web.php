<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///Auth::routes();
Route::get('/', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@index'
]);
Route::group(['prefix' => '/auth','middleware' => ['log.route']], function () {
    Route::get('/', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@index'
    ]);
    Route::post('/login', [
        'as' => 'login.post',
        'uses' => 'Auth\LoginController@authenticate'
    ]);
    Route::get('/register', [
        'as' => 'register',
        'uses' => '\App\Http\Controllers\Auth\RegisterController@index'
    ]);
    Route::post('/register', [
        'as' => 'register.post',
        'uses' => '\App\Http\Controllers\Auth\RegisterController@store'
    ]);
    Route::get('/password/email', [
        'as' => 'password.email',
        'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@index'
    ]);
    Route::get('/password/reset', [
        'as' => 'password.reset',
        'uses' => '\App\Http\Controllers\Auth\ResetPasswordController@index'
    ]);
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'Auth\LoginController@logout'
    ]);
});

Route::group(['prefix' => 'error','middleware' => ['log.route']], function () {
    Route::get('/page/{error_code}', [
        'as' => 'web.error',
        'uses' => '\App\Http\Controllers\ErrorsController@index'
    ]);
});
