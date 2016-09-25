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

// Home routes.
Route::get('/', 'HomeController@homeFront')->name('home');
Route::get('/home', 'Homecontroller@homeBackend')->name('home.backend');

// Rental routes
Route::get('/rental', 'RentalController@indexFrontEnd')->name('rental.frontend.index');
route::get('/rental/insert', 'RentalCOntroller@insertViewFrontEnd')->name('rental.frontend.insert');

// User management routes.
Route::get('backend/users/create', 'UserManagementController@create')->name('users.create');
Route::get('backend/users', 'UserManagementController@overview')->name('users.index');
Route::get('backend/users/destroy/{id}', 'UserManagementController@destroy')->name('users.destroy');
Route::post('backend/users', 'UserManagementController@store')->name('auth.new');

// Settings routes.
Route::get('settings', 'SettingsController@index')->name('settings.index');

// Activity routes
Route::get('backend/activity', 'ActivityController@index')->name('activity.index');
Route::post('backend/activity/update/{id}', 'ActivityController@update')->name('activity.update');
Route::get('backend/activity/destroy/{id}', 'ActivityController@destroy')->name('activity.destroy');
Route::post('backend/activity', 'ActivityController@store')->name('activity.store');

// Rental module routes.
Route::get('/rental/destroy/{id}', 'RentalController@destroy')->name('rental.destroy');