<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

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
        Validator::extend('square', function ($attribute, $value, $parameters, $validator) {
            $imageSize = getimagesize($value->getPathname());
            return $imageSize[0] === $imageSize[1];
        });

        Paginator::useBootstrap();
    }
}
