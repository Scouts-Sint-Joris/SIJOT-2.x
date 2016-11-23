<?php

use Illuminate\Http\Request;

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