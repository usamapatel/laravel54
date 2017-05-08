<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $excludeFiles = [app_path().'/Helpers/HelperOverload.php'];
        foreach (glob(app_path().'/Helpers/*.php') as $filename) {
            if (!in_array($filename, $excludeFiles, true)) {
                require_once $filename;
            }
        }
    }
}
