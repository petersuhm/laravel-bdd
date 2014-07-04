<?php

namespace Suhm\Auth;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['auth']->extend('suhm_auth', function($app)
        {
            return $app['Suhm\Storage\UserRepository'];
        });
    }

    public function register()
    {
        // ...
    }
}
