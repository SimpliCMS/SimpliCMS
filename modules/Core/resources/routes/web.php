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

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/link', function () {
//   $target = base_path('modules/Admin/resources/views/themes/admin');        
//   $shortcut = base_path('app/resources/views/vendor/appshell');
//   symlink($target, $shortcut);
//});