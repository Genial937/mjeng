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
    'as' => 'vendor.dashboard',
    'uses' => 'Vendors\DashboardController@index'
]);
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
        'as' => 'vendor.edit.business',
        'uses' => 'Vendors\BusinessController@update'
    ]);
});
