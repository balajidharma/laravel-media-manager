<?php

namespace BalajiDharma\LaravelMediaManger;

use Illuminate\Support\ServiceProvider;

class MediaMangerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/media-manger.php', 'media-manger'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }
}
