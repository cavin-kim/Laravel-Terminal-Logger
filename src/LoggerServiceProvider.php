<?php

namespace CavinKim\LaravelTerminalLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\View\Events\ViewRendered;
use Illuminate\Log\Events\MessageLogged;
//use Logger;
use CavinKim\LaravelTerminalLogger\Logger;

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

        // Log Laravel errors (exceptions and logged messages)
        Event::listen(MessageLogged::class, function ($event) {
            if (isset($event->context['exception'])) {
                // Log exceptions with detailed information
                $exception = $event->context['exception'];
                Logger::log(
                    'ERROR',
                    sprintf(
                        '%s [%s %s] in %s:%d',
                        $exception->getMessage(),
                        request()->method(),
                        request()->fullUrl(),
                        $exception->getFile(),
                        $exception->getLine()
                    )
                );
            } else {
                // Log other logged messages
                Logger::log('ERROR', $event->message);
            }
        });
    }

    public function register()
    {        
    }
}