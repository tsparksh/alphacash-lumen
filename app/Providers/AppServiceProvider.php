<?php

namespace App\Providers;

use App\Contracts\News\NewsParserContract;
use App\Services\News\NewsApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NewsParserContract::class,
            NewsApiService::class
        );
    }
}
