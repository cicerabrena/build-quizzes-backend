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
        $user = Auth::user();

        $data = [];

        if (isset($user)) {
            $data = array_merge($object->toArray(), ['user_id' => $user->id]);
        }

        return Subject::create(attributes: $data);
    }
}