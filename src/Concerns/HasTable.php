<?php

declare(strict_types=1);

namespace Mgandomi\LaravelHttpLogger\Concerns;

trait HasTable
{
    protected function getLogsConnectionName(): ?string
    {
        return config('http-logger.connection');
    }

    protected function getLogsTableName(): ?string
    {
        return config('http-logger.table');
    }
}
