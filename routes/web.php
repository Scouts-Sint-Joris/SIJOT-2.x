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

// Group routes.
Route::get('/groups', 'GroupController@overview')->name('frontend.groups');
Route::get('/groups/{selector}', 'GroupController@specific')->name('frontend.groups.specific');
Route::get('/groups/edit', 'GroupController@edit')->name('groups.edit');
Route::post('/groups/update/{selector}', 'GroupController@update')->name('groups.update');

// Rental routes
Route::get('/rental', 'RentalController@indexFrontEnd')->name('rental.frontend.index');
Route::get('/rental/insert', 'RentalController@insertViewFrontEnd')->name('rental.frontend.insert');
Route::get('/rental/calendar', 'RentalController@calendar')->name('rental.frontend-calendar');
Route::get('/rental/reachable', 'RentalController@domainReachable')->name('rental.frontend.reachable');
Route::get('/backend/rental/export', 'RentalController@exportExcel')->name('rental.backend.export');
Route::post('/rental/insert','RentalController@insert')->name('rental.store');

Route::get('/backend/rental', 'RentalController@indexBackEnd')->name('rental.backend');
Route::get('/backend/rental/option/{id}', 'RentalController@setOption')->name('rental.backend.option');
Route::get('/backend/rental/confirm/{id}', 'RentalController@setConfirmed')->name('rental.backend.confirm');
Route::get('/backend/rental/destroy/{id}', 'RentalController@destroy')->name('rental.backend.destroy');

// Newsletter routes
Route::post('/newsletter/register', 'MailingController@registerNewsLetter')->name('newsletter.register');

// News items.
Route::get('/backend/news', 'NewsController@index')->name('news.backend.index');
Route::get('/backend/news/draft/{id}', 'NewsController@draft')->name('news.backend.draft');
Route::get('/backend/news/publish/{id}', 'NewsController@publish')->name('news.backend.publish');
Route::get('/backend/news/destroy/{id}', 'NewsController@destroy')->name('news.backend.destroy');
Route::get('/backend/news/update/{id}', 'NewsController@edit')->name('news.backend.edit');
Route::get('/backend/news/show/{id}', 'NewsController@backendShow')->name('news.backend.show');
Route::post('/backend/news/update/{id}', 'NewsController@update')->name('news.backend.update');
Route::post('/backend/news/insert', 'NewsController@store')->name('news.backend.insert');

// Mailing routes
Route::get('/backend/mailing', 'MailingController@index')->name('backend.mailing.index');
Route::post('/backend/mailing/insert', 'MailingController@registerMailing')->name('mailing.register');
Route::get('/backend/mailing/destroy/{id}', 'MailingController@mailingDestroy')->name('backend.mailing.destroy');

// Newsletter routes.
Route::post('/newsletter/insert', 'MailingController@registerNewsLetter')->name('newsletter.insert');
Route::get('/newsletter/destroy/{string}', 'MailingController@destroyNewsletter')->name('backend.newsletter.destroy');

// User management routes.
Route::get('backend/users/reset/{id}', 'UserManagementController@resetPassword')->name('users.reset');
Route::get('backend/users/create', 'UserManagementController@create')->name('users.create');
Route::get('backend/users', 'UserManagementController@overview')->name('users.index');
Route::get('backend/users/destroy/{id}', 'UserManagementController@destroy')->name('users.destroy');
Route::get('backend/users/block/{id}', 'UserManagementController@block')->name('users.block');
Route::get('backend/users/unblock/{id}', 'UserManagementController@unblock')->name('users.unblock');
Route::post('backend/users', 'UserManagementController@store')->name('auth.new');
Route::post('/backend/users/search', 'UserManagementController@search')->name('users.search');

// Settings routes.
Route::get('settings', 'SettingsController@index')->name('settings.index');

// Environment routes.
Route::get('settings/env', 'EnvSettingsController@index')->name('settings.env');
Route::get('settings/env/backup', 'EnvSettingsController@createBackup')->name('settings.env.backup');

// Profile settings routes
Route::get('settings/profile', 'Auth\AccountController@index')->name('settings.profile');
Route::post('settings/profile', 'Auth\AccountController@updateInfo')->name('settings.profile.post');
Route::post('settips/api/key', 'Auth\AccountController@createKey')->name('settings.profile.key');
Route::post('settings/profile/security', 'Auth\AccountController@updateSecurity')->name('settings.profile.password.post');

// Api Routes
Route::get('/settings/key/regenerate/{id}', 'Auth\AccountController@RegenerateKey')->name('key.regenerate');
Route::get('/settings/key/destroy/{id}', 'Auth\AccountController@destroyKey')->name('key.destroy');

// Activity routes
Route::get('backend/activity', 'ActivityController@index')->name('activity.index');
Route::post('backend/activity/update/{id}', 'ActivityController@update')->name('activity.update');
Route::get('backend/activity/destroy/{id}', 'ActivityController@destroy')->name('activity.destroy');
Route::post('backend/activity', 'ActivityController@store')->name('activity.store');

// Debugging routes
if (config('app.debug')) {
    app()->register(PrettyRoutes\ServiceProvider::class);

    Route::get('/routes', function () {
        return view('pretty-routes::routes', [
            'routes' => Route::getRoutes(),
        ]);
    });
}
