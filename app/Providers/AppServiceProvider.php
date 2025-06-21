<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Paginator::useBootstrap();

        RateLimiter::for('otp', function (Request $request) {
            return Limit::perMinutes(2, 3)->by($request->input('user_id') ?: $request->ip());
        });

        // if (env('APP_ENV') === 'production') {
        //     $this->app['request']->server->set('HTTPS', true);
        // }
    }
}
