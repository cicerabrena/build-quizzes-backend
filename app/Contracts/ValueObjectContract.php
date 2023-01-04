<?php

namespace App\Contracts;

interface ValueObjectContract
{
    /**
     * @return array<string, string>
     */
    public function toArray(): array;
}