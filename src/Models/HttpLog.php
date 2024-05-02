<?php

declare(strict_types=1);

namespace Mgandomi\LaravelHttpLogger\Models;

use Mgandomi\LaravelHttpLogger\Casts\Hide;
use Mgandomi\LaravelHttpLogger\Casts\HideHeader;
use Mgandomi\LaravelHttpLogger\Casts\Method;
use Mgandomi\LaravelHttpLogger\Concerns\HasTable;
use DragonCode\Support\Facades\Http\Builder;
use Mgandomi\Support\Http\Builder as HttpBuilder;
use Illuminate\Database\Eloquent\Model;

class HttpLog extends Model
{
    use HasTable;

    protected $fillable = [
        'name',
        'method',
        'scheme',
        'host',
        'port',
        'path',
        'query',
        'payload',
        'response',
        'headers',
        'ip',
    ];

    protected $casts = [
        'method' => Method::class,

        'port' => 'int',

        'query'   => Hide::class,
        'payload' => Hide::class,
        'headers' => HideHeader::class,
    ];

    public function __construct(array $attributes = [])
    {
        $this->setConnection($this->getLogsConnectionName());
        $this->setTable($this->getLogsTableName());

        parent::__construct($attributes);
    }

    public function getFullUrlAttribute(): HttpBuilder
    {
        return Builder::same()
            ->withScheme($this->scheme)
            ->withHost($this->host)
            ->withPort($this->port)
            ->withPath($this->path)
            ->withQuery($this->query);
    }
}
