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
    'as' => 'admin.dashboard',
    'uses' => 'Admin\DashboardController@index'
]);
Route::group(['prefix' => '/projects','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\ProjectController')->names([
        'index' => 'admin.project',
        'createDetails' => 'admin.create'
    ]);
    Route::get('/form/details', [
        'as' => 'admin.create.project.details',
        'uses' => 'Admin\ProjectController@createDetails'
    ]);
    Route::get('/form/sites', [
        'as' => 'admin.create.project.sites',
        'uses' => 'Admin\ProjectController@createSites'
    ]);
    Route::get('/form/site/equipment/required', [
        'as' => 'admin.create.project.equipment.required',
        'uses' => 'Admin\ProjectController@createEquipmentRequired'
    ]);
    Route::get('/form/site/material/required', [
        'as' => 'admin.create.project.material.required',
        'uses' => 'Admin\ProjectController@createViewMaterialRequired'
    ]);
});
Route::group(['prefix' => '/users','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\UsersController')->names([
        'index' => 'admin.users',
    ]);
    Route::post('/new', [
        'as' => 'admin.create.user',
        'uses' => 'Admin\UsersController@store'
    ]);
    Route::get('/new', [
        'as' => 'admin.create.user',
        'uses' => 'Admin\UsersController@showCreateView'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'admin.edit.user',
        'uses' => 'Admin\UsersController@showEditView'
    ]);
    Route::post('/update', [
        'as' => 'admin.update.user',
        'uses' => 'Admin\UsersController@update'
    ]);
});
Route::group(['prefix' => '/business','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\BusinessController')->names([
        'index' => 'admin.businesses',
    ]);
    Route::post('/assign/user', [
        'as' => 'admin.assign.user.business',
        'uses' => 'Admin\BusinessController@assignUser'
    ]);

});
