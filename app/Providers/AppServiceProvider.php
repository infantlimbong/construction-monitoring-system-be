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
        Validator::extend('nip', function ($attribute, $value, $parameters, $validator) {
            // Implement your NIP validation logic here
            // Example: Check if the value consists of 16 digits
            return preg_match('/^[0-5]{16}$/', $value);
        });
    }
}
