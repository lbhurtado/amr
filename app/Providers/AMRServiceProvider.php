<?php

namespace App\Providers;

use App\MeterData;
use App\Classes\AMR;
use Opis\Events\EventDispatcher;
use App\Observers\MeterDataObserver;
use App\Repositories\MeterDataRepository;
use App\Repositories\MeterDataRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AMRServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MeterDataRepository::class, MeterDataRepositoryEloquent::class);
        $this->app->singleton(EventDispatcher::class);

        $this->app->singleton('amr', function () {
            return new AMR;
        });

        $this->app->singleton(AMR::class, function ($app) {
            return $app->make('amr');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        MeterData::observe(MeterDataObserver::class);
    }
}
