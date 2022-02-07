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
        'as' => 'login',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@index'
    ])->name('general.login');
    Route::get('/password/reset', [
        'as' => 'password-reset',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@passwordReset'
    ])->name('general.password-reset');
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@logout'
    ])->name('general.logout');
    Route::post('/', [
        'as' => 'login',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@login'
    ]);
});
