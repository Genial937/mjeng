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
    Route::get('/', [
        'as' => 'web.login',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@index'
    ]);
    Route::get('/password/reset', [
        'as' => 'web.password.reset',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@passwordReset'
    ]);
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@logout'
    ]);
    Route::post('/', [
        'as' => 'login',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@login'
    ]);
});
