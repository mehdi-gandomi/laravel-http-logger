<?php

declare(strict_types=1);

namespace DragonCode\LaravelHttpLogger\Services;

use DragonCode\LaravelHttpLogger\Models\HttpLog;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Http\Request;

class Logger
{
    public static function save(Request $request,$response): void
    {
        $response=is_string($response) ? $response:json_encode($response,JSON_UNESCAPED_UNICODE);
        self::store(
            $request->route()?->getName(),
            $request->getRealMethod(),
            $request->getScheme(),
            $request->getHost(),
            $request->getPort(),
            $request->path(),
            $request->query(),
            Arr::except($request->all(), array_keys($request->query())),
            $request->headers->all(),
            $request?->getClientIp() ?: $request?->ip(),
            $response
        );
    }

    protected static function store(
        ?string $name,
        string $method,
        string $scheme,
        string $host,
        int|string|null $port,
        string $path,
        array|string|null $query,
        array $payload,
        array $headers,
        ?string $ip,
        ?string $response
    ): void {
        HttpLog::create(compact(
            'name',
            'method',
            'scheme',
            'host',
            'port',
            'path',
            'query',
            'payload',
            'headers',
            'ip',
            'response'
        ));
    }
}
