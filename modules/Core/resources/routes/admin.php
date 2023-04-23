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

Route::group(['prefix' => 'menus'], function () {
    // Menu routes
    Route::get('/', 'MenuController@index')->name('menus.index');
    Route::post('/', 'MenuController@store')->name('menus.store');
    Route::get('create', 'MenuController@create')->name('menus.create');
    Route::get('{menu}', 'MenuController@show')->name('menus.show');
    Route::put('{menu}', 'MenuController@update')->name('menus.update');
    Route::delete('{menu}', 'MenuController@destroy')->name('menus.destroy');
    Route::get('{menu}/edit', 'MenuController@edit')->name('menus.edit');

    Route::get('menus/{menu}/menu_items/create', 'MenuItemController@create')->name('menus.menu_items.create');
    Route::post('menus/{menu}/menu_items', 'MenuItemController@store')->name('menus.menu_items.store');
    Route::get('menus/{menu}/menu_items/{menuItem}/edit', 'MenuItemController@edit')->name('menus.menu_items.edit');
    Route::put('menus/{menu}/menu_items/{menuItem}', 'MenuItemController@update')->name('menus.menu_items.update');
    Route::delete('menus/{menu}/menu_items/{menuItem}', 'MenuItemController@destroy')->name('menus.menu_items.destroy');
});
