<?php

namespace App\Actions\User;

use App\Exceptions\EmailRegisteredException;
use App\Models\User;
use Throwable;

final class UpdateUser
{

    public static function handle(User $user, array $attributes): User|Throwable
    {
        $email = User::where('email', $attributes['email'])->where('id', '<>', $user->id)->first();

        if (isset($email)) {
            throw new EmailRegisteredException("The e-mail is already registered.");
        }

        $user->update(attributes: $attributes);

        return $user;
    }

}