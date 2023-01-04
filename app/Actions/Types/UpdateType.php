<?php

namespace App\Actions\Types;

use App\Models\Type;

final class UpdateType
{

    /**
     * @param Type $type
     * @param array<string, mixed> $attributes
     */
    public static function handle(Type $type, array $attributes): void
    {
        $type->update(attributes: $attributes);
    }

}