<?php

namespace CavinKim\LaravelDetailedLogger\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogRequests
{
    public function handle(Request $request, Closure $next){
        
        // Log request details
        $method = $request->getMethod();
        $url = $request->fullUrl();
        $headers = json_encode($request->headers->all());
        $payload = json_encode($request->all());

        echo "\n[REQUEST] $method $url\n";
        echo "[HEADERS] $headers\n";
        echo "[PAYLOAD] $payload\n";

        return $next($request);
    }
}