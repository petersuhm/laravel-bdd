<?php

namespace Suhm\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

    public function register()
    {
        // I'm using a singleton because array needs to stay in memory
        $this->app->singleton(
            'Suhm\Storage\UserRepository',
            'Suhm\Storage\ArrayUserRepository'
        );
    }
}