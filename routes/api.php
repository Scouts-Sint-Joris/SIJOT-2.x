<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'Api\HomeController@index');

// Rental API section
Route::get('/rental', 'Api\RentalController@index');
Route::get('/rental/{id}', 'Api\RentalController@show');
Route::post('/rental', 'Api\RentalController@store');
Route::delete('/rental/{id}', 'Api\RentalController@destroy');
Route::match(['put', 'patch'], '/rental/{id}', 'Api\RentalController@update');

// Authorizations API section.
Route::get('/authorizations', 'Api\AuthorizationController@index');
Route::get('/authorizations/regenerate/{id}', 'Api\AuthorizationController@regenerateKey');
Route::post('/authorizations/new', 'Api\AuthorizationController@createKey');
Route::delete('/authorizations/delete/{id}', 'Api\AuthorizationController@deleteKey');
