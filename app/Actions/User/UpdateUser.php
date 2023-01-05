<?php

namespace App\Actions\User;

use App\Enums\ValidationError;
use App\Exceptions\EmailRegisteredException;
use App\Models\User;
use Throwable;

final class UpdateUser
{

    public static function handle(User $user, array $attributes): User|Throwable
    {
        $email = User::where('email', $attributes['email'])->where('id', '<>', $user->id)->first();

        if (isset($email)) {
            throw new EmailRegisteredException(ValidationError::EMAIL_ALREADY_REGISTERED->value);
        }

        $user->update(attributes: $attributes);

        return $user;
    }

}