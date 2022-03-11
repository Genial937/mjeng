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
Route::group(['prefix' => '/dashboard','middleware' => ['log.route','vendor.has.business']], function () {
    Route::get('/', [
        'as' => 'vendor.dashboard',
        'uses' => 'Vendors\DashboardController@index'
    ]);
});
Route::group(['prefix' => '/projects','middleware' => ['log.route']], function () {
    Route::resource('/', 'Vendors\ProjectController')->names([
        'index' => 'vendor.project'
    ]);
    Route::get('/equipment/required/{project_id}', [
        'as' => 'vendor.project.equipment.required',
        'uses' => 'Vendors\EquipmentRequiredController@index'
    ]);
    Route::post('/add/equipment/required', [
        'as' => 'vendor.project.add.equipment.required',
        'uses' => 'Vendors\EquipmentRequiredController@assignEquipmentFromInventory'
    ]);
    Route::post('/remove/equipment/required', [
        'as' => 'vendor.project.remove.equipment.required',
        'uses' => 'Vendors\EquipmentRequiredController@removeEquipmentFromInventory'
    ]);
    Route::get('/material/required/{project_id}', [
        'as' => 'vendor.project.material.required',
        'uses' => 'Vendors\MaterialRequiredController@index'
    ]);
});

Route::group(['prefix' => '/business','middleware' => ['log.route']], function () {
    Route::resource('/', 'Vendors\BusinessController')->names([
        'index' => 'vendor.businesses'
    ]);
    Route::get('/create', [
        'as' => 'vendor.create.business',
        'uses' => 'Vendors\BusinessController@showCreateView'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vendor.edit.business',
        'uses' => 'Vendors\BusinessController@showEditView'
    ]);
    Route::post('/create', [
        'as' => 'vendor.create.business',
        'uses' => 'Vendors\BusinessController@store'
    ]);
    Route::post('/update', [
        'as' => 'vendor.update.business',
        'uses' => 'Vendors\BusinessController@update'
    ]);
    Route::post('/add/users', [
        'as' => 'vendor.add.business.user',
        'uses' => 'Vendors\BusinessController@addUsers'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vendor.business.delete',
        'uses' => 'Vendors\BusinessController@destroy'
    ]);
});
Route::group(['prefix' => '/users','middleware' => ['log.route']], function () {
    Route::resource('/', 'Vendors\UsersController')->names([
        'index' => 'vendor.users',
    ]);
    Route::post('/new', [
        'as' => 'vendor.create.user',
        'uses' => 'Vendors\UsersController@store'
    ]);
    Route::get('/new', [
        'as' => 'vendor.create.user',
        'uses' => 'Vendors\UsersController@showCreateView'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vendor.edit.user',
        'uses' => 'Vendors\UsersController@showEditView'
    ]);
    Route::post('/update', [
        'as' => 'vendor.update.user',
        'uses' => 'Vendors\UsersController@update'
    ]);
    Route::post('/change/password', [
        'as' => 'vendor.change.user.password',
        'uses' => 'Vendors\UsersController@changePassword'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vendor.user.delete',
        'uses' => 'Vendors\UsersController@destroy'
    ]);
});
Route::group(['prefix' => '/equipment','middleware' => ['log.route','vendor.has.business']], function () {
    Route::get('/', [
        'as' => 'vendor.inventory.equipment',
        'uses' => 'Vendors\EquipmentController@index'
    ]);
    Route::get('/create', [
        'as' => 'vendor.inventory.create.equipment',
        'uses' => 'Vendors\EquipmentController@showCreateView'
    ]);
    Route::post('/create', [
        'as' => 'vendor.create.equipment',
        'uses' => 'Vendors\EquipmentController@store'
    ]);
    Route::post('/images/{side}', [
        'as' => 'vendor.inventory.equipment.images',
        'uses' => 'Vendors\EquipmentController@storeImages'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vendor.inventory.edit.equipment',
        'uses' => 'Vendors\EquipmentController@showEditView'
    ]);
    Route::post('/update', [
        'as' => 'vendor.edit.equipment',
        'uses' => 'Vendors\EquipmentController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vendor.delete.equipment',
        'uses' => 'Vendors\EquipmentController@destroy'
    ]);
});
Route::group(['prefix' => '/material','middleware' => ['log.route','vendor.has.business']], function () {
    Route::get('/', [
        'as' => 'vendor.inventory.material',
        'uses' => 'Vendors\MaterialController@index'
    ]);
    Route::get('/create', [
        'as' => 'vendor.inventory.create.material',
        'uses' => 'Vendors\MaterialController@showCreateView'
    ]);
    Route::post('/create', [
        'as' => 'vendor.material.create',
        'uses' => 'Vendors\MaterialController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vendor.inventory.edit.material',
        'uses' => 'Vendors\MaterialController@showEditView'
    ]);
    Route::post('/edit', [
        'as' => 'vendor.material.edit',
        'uses' => 'Vendors\MaterialController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vendor.delete.material',
        'uses' => 'Vendors\MaterialController@destroy'
    ]);
});
