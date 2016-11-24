<?php

namespace App\Providers;

use App\Rental;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // If multiple instances exists of providers.
        // you need to split this up add register sperated service providers.
        // -----------------------------------------------------------------------
        // @see: https://laracasts.com/series/laravel-5-fundamentals/episodes/25

        // Rental indicater view composer.
        // ----
        // Templates: layouts.backend

        // Check if the table(s) exists
        if (Schema::hasTable('rental_statuses') && Schema::hasTable('rentals')) {
            view()->composer('layouts.back-end', function ($view) {
                $view->with('new', Rental::whereHas('status', function ($query) {
                    $query->where('name', 'Nieuwe aanvraag');
                })->count());

                $view->with('option', Rental::whereHas('status', function ($query) {
                    $query->where('name', 'Optie');
                })->count());

                $view->with('confirmed', Rental::whereHas('status', function ($query) {
                    $query->where('name', 'Bevestigd');
                })->count());
            });

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
