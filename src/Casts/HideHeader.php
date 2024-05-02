<?php

declare(strict_types=1);

namespace Mgandomi\LaravelHttpLogger\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class HideHeader extends Hide implements CastsAttributes
{
    protected function process(array $values): array
    {
        foreach ($values as $key => &$value) {
            if ($this->toHide($key)) {
                $value = [$this->hide($value[0])];
            }
        }

        return $values;
    }
}
