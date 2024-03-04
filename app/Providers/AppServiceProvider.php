<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('custom_date', function ($attribute, $value, $parameters, $validator) {
            // Adjust the date format as per your frontend library
            $date = \DateTime::createFromFormat('m/d/Y', $value);
            return $date && $date->format('Y-m-d') === $value;
        });
    }
}
