<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Optimus\Optimus;

class OptimusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Optimus::class, function ($app) {
            return new Optimus(config('optimus.prime'), config('optimus.inverse'), config('optimus.random'));
        });
    }
}
