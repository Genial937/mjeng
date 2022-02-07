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


Route::get('/', '\App\Http\Controllers\Admin\AutheticationController@index')->middleware('log.route');
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => '\App\Http\Controllers\Admin\DashboardController@index'])->middleware('log.route');
Route::group(['prefix' => 'auth','middleware' => 'log.route'], function () {
    Route::get('/', [
        'as' => 'login',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@index'
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
Route::group(['prefix' => 'roles','middleware' =>'log.route', ['ability_:admin,create-roles|view-roles|update-roles|delete-roles']], function () {
    Route::get('/', [
        'as' => 'role-permission-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@roles'
    ]);
    Route::get('/create', [
        'as' => 'create-role-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@createRoleView'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'edit-role-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@roleEditView'
    ]);
    Route::post('/new', [
        'as' => 'create-role',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@createRole'
    ]);
    Route::post('/update', [
        'as' => 'edit-role',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@editRole'
    ]);
    Route::post('/delete', [
        'as' => 'delete-role',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@deleteRole'
    ]);
});
Route::group(['prefix' => 'permissions','middleware' =>'log.route', ['ability_:admin,create-roles|view-roles|update-roles|delete-roles']], function () {
    Route::get('/create', [
        'as' => 'create-permission-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@createPermissionView'
    ]);
    Route::post('/new', [
        'as' => 'create-permission',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@createPermission'
    ]);
});
Route::group(['prefix' => 'users','middleware' =>'log.route', ['ability_:admin,create-users|view-users|update-users|delete-users']], function () {
    Route::get('/', [
        'as' => 'users-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@usersView'
    ]);
    Route::get('/create', [
        'as' => 'create-user-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@userCreateView'
    ]);
    Route::post('/new', [
        'as' => 'create-user',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@createUser'
    ]);
    Route::get('/update/{id}', [
        'as' => 'update-user-view',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@userEditView'
    ]);
    Route::post('/edit', [
        'as' => 'update-user',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@updateUser'
    ]);
    Route::post('/edit/password/{id}', [
        'as' => 'user-update-password',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@changePassword'
    ]);
    Route::post('/delete', [
        'as' => 'user-delete',
        'uses' => '\App\Http\Controllers\Admin\AutheticationController@deleteUser'
    ]);
});

Route::group(['prefix' => 'profile','middleware' =>'log.route',], function () {
    Route::get('/', [
        'as' => 'profile',
        'uses' => '\App\Http\Controllers\Admin\ProfileController@index'
    ]);
    Route::post('/update', [
        'as' => 'updateProfile',
        'uses' => '\App\Http\Controllers\Admin\ProfileController@updateUser'
    ]);
    Route::post('/password', [
        'as' => 'updatePassword',
        'uses' => '\App\Http\Controllers\Admin\ProfileController@changePassword'
    ]);
});

