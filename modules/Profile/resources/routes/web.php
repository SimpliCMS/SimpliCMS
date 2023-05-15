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
Route::prefix('profile')->group(function () {
//    Route::get('{username}', 'ProfileController@show')->name('profile.show');
    Route::get('edit', 'ProfileController@settingsIndex')->name('profile.settings');
    Route::get('edit/info', 'ProfileController@settingsInfo')->name('profile.settings.info');
    Route::put('/update/{profile}', 'ProfileController@update')->name('profile.update');
    Route::put('/{user}/{profile}', 'ProfileController@updateAvatar')->name('profile.update.avatar');
    Route::get('/{user}/{profile}', 'ProfileController@deleteAvatar')->name('profile.delete.avatar');
});