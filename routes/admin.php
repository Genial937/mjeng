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

Route::group(['prefix' => '/','middleware' => ['log.route']], function () {
    Route::resource('dashboard', 'Admin\DashboardController')->names([
        'index' => 'admin.dashboard'
    ]);
    Route::resource('projects', 'Admin\ProjectController')->names([
        'index' => 'admin.project',
        'createDetails' => 'admin.create'
    ]);
    Route::get('/project/form/details', [
        'as' => 'admin.create.project.details',
        'uses' => 'Admin\ProjectController@createDetails'
    ]);
    Route::get('/project/form/sites', [
        'as' => 'admin.create.project.sites',
        'uses' => 'Admin\ProjectController@createSites'
    ]);
    Route::get('/project/form/site/equipment/required', [
        'as' => 'admin.create.project.equipment.required',
        'uses' => 'Admin\ProjectController@createEquipmentRequired'
    ]);
    Route::get('/project/form/site/material/required', [
        'as' => 'admin.create.project.material.required',
        'uses' => 'Admin\ProjectController@createViewMaterialRequired'
    ]);
});
