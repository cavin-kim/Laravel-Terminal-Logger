<?php

namespace CavinKim\LaravelTerminalLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use CavinKim\LaravelTerminalLogger\Logger;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Log request details
        Logger::request(
            $request->getMethod(),
            $request->fullUrl(),
            $request->headers->all(),
            $request->all()
        );

        $response = $next($request);

        // Log response
        Logger::log('RESPONSE', json_encode([
            'status' => $response->status(),
            'content_type' => $response->headers->get('Content-Type'),
        ]));

        return $response;
    }
}