<?php

namespace App\Factories;

use App\ValueObjects\SubjectValueObject;

final class SubjectFactory
{
    public static function make(mixed $attributes): SubjectValueObject
    {
        return new SubjectValueObject(
            name: strval(data_get($attributes, 'name')),
            slug: strval(data_get($attributes, 'slug')),
            description: strval(data_get($attributes, 'description')),
        );
    }
}