<?php


/*
  |--------------------------------------------------------------------------
  | Admin Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register Admin web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" "auth" and "role" middleware groups to lock them to the Admin.
  |
 */
Route::group(['prefix' => 'bookables'], function () {
    // Menu routes
    Route::get('/', 'BookableController@index')->name('bookables.admin.index');
    Route::post('/', 'BookableController@store')->name('bookables.admin.store');
    Route::get('create', 'BookableController@create')->name('bookables.admin.create');
    Route::get('{bookable}', 'BookableController@show')->name('bookables.admin.show');
    Route::put('{bookable}', 'BookableController@update')->name('bookables.admin.update');
    Route::delete('{bookable}', 'BookableController@destroy')->name('bookables.admin.destroy');
    Route::get('{bookable}/edit', 'BookableController@edit')->name('bookables.admin.edit');
});
