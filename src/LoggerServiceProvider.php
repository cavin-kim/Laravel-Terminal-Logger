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
        // Middleware for logging HTTP requests
        $this->app['router']->aliasMiddleware('log.requests', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);
        $this->app['router']->pushMiddlewareToGroup('web', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);
        $this->app['router']->pushMiddlewareToGroup('api', \CavinKim\LaravelTerminalLogger\Middleware\LogRequests::class);

        // Log database queries
        Event::listen(QueryExecuted::class, function ($query) {
            Logger::query($query->sql, $query->time);
        });

        // Log rendered views
        Event::listen(ViewRendered::class, function ($event) {
            Logger::view($event->view->getName(), $event->view->getData());
        });
    }

    public function register()
    {
     
    }
}