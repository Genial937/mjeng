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
Route::get('/', [
    'as' => 'web.login',
    'uses' => 'Auth\LoginController@index'
]);

Auth::routes();
Route::group(['prefix' => 'auth','middleware' => ['log.route','user.type']], function () {
    Route::post('/login', [
        'as' => 'web.login.post',
        'uses' => 'Auth\LoginController@authenticate'
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
Route::group(['prefix' => 'error','middleware' => ['log.route']], function () {
    Route::get('/page/{error_code}', [
        'as' => 'web.error',
        'uses' => '\App\Http\Controllers\ErrorsController@index'
    ]);
});
