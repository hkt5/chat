<?php

namespace App\Providers;

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
        $this->app->register(\NunoMaduro\Larastan\LarastanServiceProvider::class);
        $this->app->instance('path.storage', app()->basePath() . DIRECTORY_SEPARATOR . 'storage');
        $this->app->instance('path.config', app()->basePath() . DIRECTORY_SEPARATOR . 'config');
    }
}
