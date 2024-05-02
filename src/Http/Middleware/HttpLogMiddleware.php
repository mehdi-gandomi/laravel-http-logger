<?php

declare(strict_types=1);

namespace Mgandomi\LaravelHttpLogger\Http\Middleware;

use Closure;
use Mgandomi\LaravelHttpLogger\Services\Logger;
use Illuminate\Http\Request;

class HttpLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response=$next($request);
        if ($this->enabled()) {
            Logger::save($request,$response);
        }
        return $response;
    }

    protected function enabled(): bool
    {
        return config('http-logger.enabled', true);
    }
}
