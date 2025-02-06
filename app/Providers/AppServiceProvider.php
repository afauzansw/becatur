<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Contract\Firestore as FirestoreContract;
use Kreait\Firebase\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FirestoreContract::class, function ($app) {
            return (new Factory)
                ->withServiceAccount(config('firebase.credentials')) // Pastikan ini benar
                ->createFirestore();
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
