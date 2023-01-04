<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasUuid
{

    /**
     * @return void
     */
    public static function bootHasUuid(): void
    {
        static::creating(fn (self $model) => $model->identification = Str::uuid()->toString());
    }

}