<?php

namespace App\Factories;

use App\ValueObjects\TypeValueObject;

final class TypeFactory
{

    /**
     * @param mixed $attributes
     * @return TypeValueObject
     */
    public static function make(mixed $attributes): TypeValueObject
    {
        return new TypeValueObject(
            name: strval(data_get($attributes, 'name'))
        );
    }

}