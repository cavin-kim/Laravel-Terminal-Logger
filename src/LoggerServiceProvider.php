<?php

namespace CavinKim\LaravelTerminalLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Events\ViewRendered;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register middleware to log requests
        $this->app['router']->aliasMiddleware('log.requests', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);

        // Apply middleware globally
        $this->app['router']->pushMiddlewareToGroup('web', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);
        $this->app['router']->pushMiddlewareToGroup('api', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);

        // Listen to database query events
        Event::listen(QueryExecuted::class, \CavinKim\LaravelTerminalLogger\Listeners\LogQueries::class);

        Event::listen(ViewRendered::class, function ($event) {
            echo "\n[VIEW] {$event->view->getName()}\n";
        });
    }

    public function register()
    {
        // Register any bindings if needed
    }
}