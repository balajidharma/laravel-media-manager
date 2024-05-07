<?php

namespace BalajiDharma\LaravelMediaManger;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
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
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/media-manger.php' => config_path('media-manger.php'),
            ], ['config', 'media-manger-config', 'media-manger', 'admin-core', 'admin-core-config']);

            $this->publishes([
                __DIR__.'/../database/migrations/create_mediable_tables.php.stub' => $this->getMigrationFileName('create_mediable_tables.php'),
            ], ['migrations', 'media-manger-migrations', 'media-manger', 'admin-core', 'admin-core-migrations']);
        }
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
