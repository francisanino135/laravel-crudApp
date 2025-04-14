<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Auth::class, function ($app) {
            return (new Factory())
                ->withServiceAccount(storage_path('app/firebase/credentials.json'))
                ->createAuth();
        });
    }

    public function boot()
    {
        //
    }
}
