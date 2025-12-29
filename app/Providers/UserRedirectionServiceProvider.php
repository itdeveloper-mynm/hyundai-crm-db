<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Events\RouteMatched;
use App\Http\Middleware\UserRedirection;

class UserRedirectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Listen to the RouteMatched event
        Route::matched(function (RouteMatched $event) {
            $route = $event->route;

            // Check if the route name is 'dashboard'
            if ($route->getName() === 'dashboard') {
                // Add the UserRedirection middleware dynamically
                $route->middleware([UserRedirection::class]);
            }
        });
    }

}
