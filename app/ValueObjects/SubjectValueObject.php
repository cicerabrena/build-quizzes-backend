<?php

namespace App\ValueObjects;

use App\Contracts\ValueObjectContract;

final class SubjectValueObject implements ValueObjectContract
{
    public function __construct(public string $name,
                                public string $slug,
                                public ?string $description)
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description ?? ''
        ];
    }
}