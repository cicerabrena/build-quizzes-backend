<?php

namespace App\Actions\User;

use App\Contracts\ValueObjectContract;
use App\Enums\ValidationError;
use App\Exceptions\InvalidPasswordException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Throwable;

final class Login
{
    public static function handle(ValueObjectContract $object): Model|Throwable
    {
        $atrributes = $object->toArray();

        /** @var User */
        $user = User::whereEmail($atrributes['email'])->first();

        if (!Hash::check($atrributes['password'], $user->password)) {
            throw new InvalidPasswordException(ValidationError::PASSWORD_INCORRECT->value);
        }

        $token = $user->createToken('token')->plainTextToken;

        $user->setAttribute('token', $token);

        return $user;
    }
}