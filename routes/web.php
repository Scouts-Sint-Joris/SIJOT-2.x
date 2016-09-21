<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Authencation routes.

Auth::routes();

// User management routes.
Route::get('backend/users/create', 'UserManagementController@create')->name('users.create');
Route::get('backend/users', 'UserManagementController@overview')->name('users.index');
Route::get('backend/users/destroy/{id}', 'UserManagementController@destroy')->name('users.destroy');
Route::post('backend/users', 'UserManagementController@store')->name('auth.new');

Route::get('settings', 'SettingsController@index')->name('settings.index');

// Group module routes.

// Rental module routes.
Route::get('/rental/destroy/{id}', 'RentalController@destroy')->name('rental.destroy');