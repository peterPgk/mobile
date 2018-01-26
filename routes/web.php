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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {


    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'HomeController@search')->name('search');

    Route::get('phone/{phone}', 'PhonesController@show')->name('show.phone');
    Route::get('accessory/{accessory}', 'AccessoriesController@show')->name('show.accessory');


    /**
     * ADMIN ROUTES
     */
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function () {

            Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');

            Route::resource('phone', 'PhonesController')->except('show');
            Route::resource('accessory', 'AccessoriesController')->except('show');
    });
});
