<?php

namespace App\Actions\User;

use App\Contracts\ValueObjectContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class RegisterUser
{
    public static function handle(ValueObjectContract $object): Model
    {
        return User::query()->create(attributes: $object->toArray());
    }
}