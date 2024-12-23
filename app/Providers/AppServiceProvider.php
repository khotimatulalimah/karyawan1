<?php

namespace App\Providers;
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client;
use League\Flysystem\Filesystem;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Storage::extend('dropbox', function ($app, $config) {
            $client = new Client($config['access_token']);
            return new Filesystem(new DropboxAdapter($client));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
