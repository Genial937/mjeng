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


Route::group(['prefix' => 'auth','middleware' => 'log.route'], function () {
    Route::resource('login', 'Auth\LoginController')->names([
        'index' => 'web.login',
        'autheticate' => 'web.login.post'
    ]);
    Route::get('/forgot/password', [
        'as' => 'web.forgot.password',
        'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@index'
    ]);
    Route::get('/password/reset', [
        'as' => 'web.password.reset',
        'uses' => '\App\Http\Controllers\Auth\ResetPasswordController@index'
    ]);
    Route::get('/logout', [
        'as' => 'web.logout',
        'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
    ]);
});
