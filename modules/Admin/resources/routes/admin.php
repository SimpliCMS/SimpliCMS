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
Route::get('/', 'DashboardController@index')->name('admin.index');
Route::resource('media', 'Modules\Admin\Http\Controllers\Admin\MediaController')->only(['update', 'destroy', 'store'])->names([
    'update' => 'admin.media.update',
    'destroy' => 'admin.media.destroy',
    'store' => 'admin.media.store'
]);
