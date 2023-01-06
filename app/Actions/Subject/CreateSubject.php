<?php

namespace App\Actions\Subject;

use App\Contracts\ValueObjectContract;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class CreateSubject
{
    public static function handle(ValueObjectContract $object): Model
    {
        $userId = Auth::user()->id;

        $data = array_merge($object->toArray(), ['user_id' => $userId]);

        return Subject::create(attributes: $data);
    }
}