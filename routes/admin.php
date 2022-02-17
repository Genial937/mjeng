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
        'uses' => 'Admin\BusinessController@attachUser'
    ]);

});
Route::group(['prefix' => '/config/counties','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\CountyController')->names([
        'index' => 'admin.counties',
    ]);
    Route::post('/config/add/county', [
        'as' => 'admin.create.county',
        'uses' => 'Admin\CountyController@store'
    ]);
    Route::post('/config/edit/county', [
        'as' => 'admin.edit.county',
        'uses' => 'Admin\CountyController@update'
    ]);
});

Route::group(['prefix' => '/config/subcounties','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\SubCountyController')->names([
        'index' => 'admin.subcounties',
    ]);
    Route::post('/config/create/subcounty', [
        'as' => 'admin.create.subcounty',
        'uses' => 'Admin\SubCountyController@store'
    ]);
});
Route::group(['prefix' => '/config/currency','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\CurrencyController')->names([
        'index' => 'admin.currencies',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.currency',
        'uses' => 'Admin\CurrencyController@store'
    ]);

});
Route::group(['prefix' => '/config/measurement/units','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\MeasurementUnitsController')->names([
        'index' => 'admin.measurement.units',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.measurement.units',
        'uses' => 'Admin\MeasurementUnitsController@store'
    ]);

});
Route::group(['prefix' => '/config/material/type','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\MaterialTypeController')->names([
        'index' => 'admin.material.type',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.material.type',
        'uses' => 'Admin\MaterialTypeController@store'
    ]);

});
Route::group(['prefix' => '/config/material/class','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\MaterialClassController')->names([
        'index' => 'admin.material.class',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.material.class',
        'uses' => 'Admin\MaterialClassController@store'
    ]);

});
Route::group(['prefix' => '/config/equipment/type','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\EquipmentTypeController')->names([
        'index' => 'admin.equipment.type',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.equipment.type',
        'uses' => 'Admin\EquipmentTypeController@store'
    ]);

});
Route::group(['prefix' => '/config/equipment/make','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\EquipmentMakeController')->names([
        'index' => 'admin.equipment.make',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.equipment.make',
        'uses' => 'Admin\EquipmentMakeController@store'
    ]);
});
Route::group(['prefix' => '/config/equipment/model','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\EquipmentModelController')->names([
        'index' => 'admin.equipment.model',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.equipment.model',
        'uses' => 'Admin\EquipmentModelController@store'
    ]);

});
Route::group(['prefix' => '/config/task','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\TaskController')->names([
        'index' => 'admin.task',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.task',
        'uses' => 'Admin\TaskController@store'
    ]);
    Route::post('/materials', [
        'as' => 'admin.task.materials',
        'uses' => 'Admin\TaskController@store'
    ]);

});
