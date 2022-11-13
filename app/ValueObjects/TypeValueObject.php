<?php

namespace App\ValueObjects;

use App\Contracts\ValueObjectContract;

final class TypeValueObject implements ValueObjectContract
{
    public function __construct(public string $name)
    {
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
