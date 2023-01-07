<?php

namespace App\Actions\Subject;

use App\Contracts\ValueObjectContract;
use App\Enums\ValidationError;
use App\Exceptions\NameRegisteredException;
use App\Exceptions\SlugRegisteredException;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

final class UpdateSubject
{
    public static function handle(Subject $subject, ValueObjectContract $object): Model
    {
        $atrributes = $object->toArray();

        if (self::checkIfValueIsNotUnique($subject->identification, 'name', $atrributes['name'])) {
            throw new NameRegisteredException(ValidationError::SUBJECT_NAME_ALREADY_REGISTERED->value);
        }

        if (self::checkIfValueIsNotUnique($subject->identification, 'slug', $atrributes['slug'])) {
            throw new SlugRegisteredException(ValidationError::SUBJECT_SLUG_ALREADY_REGISTERED->value);
        }

        $subject->update(attributes: $atrributes);

        return $subject;
    }

    private static function checkIfValueIsNotUnique(string $identification, string $label, string $value): bool
    {
        $result = Subject::query()->where($label, $value)
                                ->where('identification', '<>', $identification)
                                ->first();

        return isset($result);
    }
}