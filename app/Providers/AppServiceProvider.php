<?php

namespace App\Providers;

use App\Service\Currency\ICurrency;
use App\Service\Currency\NavasanTech;
use App\Service\Movie\IMovie;
use App\Service\Movie\MovieAPIIR;
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
        $this->app->bind(IMovie::class, MovieAPIIR::class);
        $this->app->bind(ICurrency::class, NavasanTech::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
