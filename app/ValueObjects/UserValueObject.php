<?php

namespace App\ValueObjects;

use App\Contracts\ValueObjectContract;

final class UserValueObject implements ValueObjectContract
{
    public function __construct(public string $name,
                                public string $email,
                                public string $password) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}