<?php

namespace App\Http\Requests\Api\Subject;

use App\Enums\SubjectValidationNumbers;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:' . SubjectValidationNumbers::MIN_LENGTH_NAME->value,
                'max:' . SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value,
                'unique:subjects,name'
            ],

            'slug' => [
                'required',
                'string',
                'unique:subjects,slug',
                'max:' . SubjectValidationNumbers::MAX_LENGTH_SLUG->value
            ],

            'description' => [
                'nullable',
                'string',
                'max:' . SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name is not valid.',
            'name.min' => "The name must have at least " . SubjectValidationNumbers::MIN_LENGTH_NAME->value . " caracteres.",
            'name.max' => "The name must have max " . SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value . " caracteres.",
            'name.unique' => 'The name is already registered.',

            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug is not valid.',
            'slug.max' => "The slug must have max " . SubjectValidationNumbers::MAX_LENGTH_SLUG->value . " caracteres.",
            'slug.unique' => 'The slug is already registered.',

            'description.string' => 'The description is not valid',
            'description.max' => "The description must have max " . SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value . " caracteres."
        ];
    }
}
