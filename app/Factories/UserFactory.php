<?php

namespace App\Factories;

use App\ValueObjects\UserValueObject;

final class UserFactory
{
    public static function make(mixed $attributes): UserValueObject
    {
        return new UserValueObject(
            name: strval(data_get($attributes, 'name')),
            email: strval(data_get($attributes, 'email')),
            password: strval(data_get($attributes, 'password')),
        );
    }
}