<?php

declare(strict_types=1);

namespace Mgandomi\LaravelHttpLogger\Casts;

use Mgandomi\Support\Facades\Helpers\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Method implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Str::upper($value);
    }
}
