<?php

namespace App\Providers;

use App\Weighin;
use App\Observers\WeighinObserver;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Weighin::observe(WeighinObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('rotate', function () {
            $item = $this->shift();
            $this->push($item);

            return $this;
        });

        Collection::macro('choose', function ($number) {
        });
    }
}
