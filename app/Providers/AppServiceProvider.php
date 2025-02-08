<?php

namespace App\Providers;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(Logout::class, function ($app) {
            return new Logout();
        });
        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }
    }
}
