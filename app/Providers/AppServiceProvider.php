<?php

namespace App\Providers;

use App\Providers\DataProviders\SportDataIoProvider;
use App\Providers\DataProviders\TestingNbaDatasProvider;
use App\Providers\DataProviders\NbaDatasProvider;
use App\Providers\DataProviders\NullObjectNbaDatasProvider;
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
        $this->app->bind(NbaDatasProvider::class, function ($app) {
            return match (config('external-api.nbaDatasProvider')) {
                'sportdataio' => new SportDataIoProvider(),
                'testing' => new TestingNbaDatasProvider(),
                default => new NullObjectNbaDatasProvider(),
            };
        });
    }
}