<?php

namespace App\Actions\Types;

use App\Contracts\ValueObjectContract;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;

final class CreateNewType
{
    /**
     * @param ValueObjectContract $object
     * @return Model
     */
    public static function handle(ValueObjectContract $object): Model
    {
        return Type::query()->create(attributes: $object->toArray());
    }
}