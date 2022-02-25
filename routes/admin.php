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


use Illuminate\Support\Facades\Route;

Route::get('/', [
    'as' => 'admin.dashboard',
    'uses' => 'Admin\DashboardController@index'
]);
Route::group(['prefix' => '/projects','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\ProjectController')->names([
        'index' => 'admin.project',
        'createDetails' => 'admin.create'
    ]);
    Route::get('/form/create/details', [
        'as' => 'admin.form.create.project.details',
        'uses' => 'Admin\ProjectController@createDetailView'
    ]);
    Route::post('/create/details', [
        'as' => 'admin.create.project.details',
        'uses' => 'Admin\ProjectController@store'
    ]);
    Route::get('/form/create/site/{project_id}', [
        'as' => 'admin.form.create.project.sites',
        'uses' => 'Admin\SiteController@index'
    ]);
    Route::post('/create/site', [
        'as' => 'admin.create.sites.details',
        'uses' => 'Admin\SiteController@store'
    ]);
    Route::post('/edit/site', [
        'as' => 'admin.update.project.sites',
        'uses' => 'Admin\SiteController@update'
    ]);
    Route::get('/delete/site/{id}', [
        'as' => 'admin.delete.project.site',
        'uses' => 'Admin\SiteController@destroy'
    ]);
    Route::get('/find/site/{id}', [
        'as' => 'admin.find.project.site',
        'uses' => 'Admin\SiteController@find'
    ]);
    Route::get('/form/create/equipment/required/{project_id}', [
        'as' => 'admin.form.create.project.equipment.required',
        'uses' => 'Admin\EquipmentRequiredController@index'
    ]);
    Route::post('/create/equipment/required', [
        'as' => 'admin.create.project.equipment.required',
        'uses' => 'Admin\EquipmentRequiredController@store'
    ]);
    Route::post('/update/equipment/required', [
        'as' => 'admin.update.project.equipment.required',
        'uses' => 'Admin\EquipmentRequiredController@update'
    ]);
    Route::get('/delete/equipment/required/{id}', [
        'as' => 'admin.delete.equipment.required',
        'uses' => 'Admin\EquipmentRequiredController@destroy'
    ]);
    Route::get('/form/create/material/required/{project_id}', [
        'as' => 'admin.form.create.material.required',
        'uses' => 'Admin\MaterialRequiredController@index'
    ]);
    Route::post('/create/material/required', [
        'as' => 'admin.create.project.material.required',
        'uses' => 'Admin\MaterialRequiredController@store'
    ]);
    Route::get('/delete/material/required/{id}', [
        'as' => 'admin.delete.material.required',
        'uses' => 'Admin\SiteController@destroy'
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
    Route::post('/change/password', [
        'as' => 'admin.change.user.password',
        'uses' => 'Admin\UsersController@changePassword'
    ]);
});
Route::group(['prefix' => '/business','middleware' => ['log.route']], function () {
    Route::resource('/contractor', 'Admin\BusinessController')->names([
        'index' => 'admin.contractor.businesses'
    ]);
    Route::get('/contractor/create', [
        'as' => 'admin.create.contractor',
        'uses' => 'Admin\BusinessController@showCreateContractorView'
    ]);
    Route::get('/contractor/edit/{id}', [
        'as' => 'admin.edit.contractor',
        'uses' => 'Admin\BusinessController@showEditContractorView'
    ]);
    Route::post('/add/users', [
        'as' => 'admin.add.business.user',
        'uses' => 'Admin\BusinessController@addUsers'
    ]);
    Route::post('/contractor/detach/user', [
        'as' => 'admin.detach.business.user',
        'uses' => 'Admin\BusinessController@detachUser',
    ]);
    Route::post('/contractor/add', [
        'as' => 'admin.create.business.contractor',
        'uses' => 'Admin\BusinessController@store'
    ]);
    Route::post('/contractor/update', [
        'as' => 'admin.update.business.contractor',
        'uses' => 'Admin\BusinessController@update'
    ]);
});
Route::group(['prefix' => '/config/county','middleware' => ['log.route']], function () {
    Route::resource('/', 'Admin\CountyController')->names([
        'index' => 'admin.counties',
    ]);
    Route::post('/add', [
        'as' => 'admin.create.county',
        'uses' => 'Admin\CountyController@store'
    ]);
    Route::post('/edit', [
        'as' => 'admin.edit.county',
        'uses' => 'Admin\CountyController@update'
    ]);
    Route::get('/find/{id}', [
        'as' => 'admin.find.county',
        'uses' => 'Admin\CountyController@find'
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
    Route::get('/find/{id}', [
        'as' => 'admin.find.material.type',
        'uses' => 'Admin\MaterialTypeController@find'
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
    Route::get('/{id}', [
        'as' => 'admin.get.equipment.type',
        'uses' => 'Admin\EquipmentTypeController@find'
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
    Route::get('/find/{id}', [
        'as' => 'admin.find.task',
        'uses' => 'Admin\TaskController@find'
    ]);

});
