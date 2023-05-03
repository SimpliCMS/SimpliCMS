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

    Route::get('settings', 'ProfileController@settingsIndex')->name('profile.settings');
     Route::get('settings/info', 'ProfileController@settingsInfo')->name('profile.settings.info');
     
     Route::put('/{user}/{profile}', 'ProfileController@updateAvatar')->name('profile.update.avatar');
     Route::get('/{user}/{profile}', 'ProfileController@deleteAvatar')->name('profile.delete.avatar');