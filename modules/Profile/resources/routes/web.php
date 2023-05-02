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
        dd('This is the Profile module index page. Build something great!');
    });
    
    Route::put('/{user}/{profile}', 'ProfileController@update')->name('profile.update');