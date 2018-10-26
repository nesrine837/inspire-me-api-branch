<?php

namespace App\Providers\v1;

use Illuminate\Support\ServiceProvider;
use App\Services\v1\QuotesService;
use App\Services\v1\QuoteesService;
use App\Services\v1\NationalitiesService;

class InspireMeProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuotesService::class, function ($app) {
            return new QuotesService();
        });

        $this->app->bind(QuoteesService::class, function ($app) {
            return new QuoteesService();
        });
        $this->app->bind(NationalitiesService::class, function ($app) {
            return new NationalitiesService();
        });
    }
}
