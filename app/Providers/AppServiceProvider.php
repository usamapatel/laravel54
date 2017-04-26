<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//https://laravel-news.com/laravel-5-4-key-too-long-error #TODO

class AppServiceProvider extends ServiceProvider
{
    protected $localProviders;
    protected $localAliases;

    public function __construct($app)
    {
        $this->app = $app;
        $this->localProviders = config('app.localProviders');
        $this->localAliases = config('app.localAliases');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //register local dev service providers
        if ($this->app->isLocal() && !empty($this->localProviders)) {
            foreach ($this->localProviders as $provider) {
                $this->app->register($provider);
            }
        }
        //register local dev alias
        if ($this->app->isLocal() && !empty($this->localAliases)) {
            foreach ($this->localAliases as $alias => $facade) {
                $this->app->alias($alias, $facade);
            }
        }
    }
}
