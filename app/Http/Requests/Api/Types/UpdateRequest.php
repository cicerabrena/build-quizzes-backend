<?php

namespace App\Http\Requests\Api\Types;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'min:5',
                'max:30',
                Rule::unique('types', 'name')->ignore($this->route('uuid'), 'identification')
            ]
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        /** @var string */
        $name = $this->name;

        return [
            'required' => 'The name of the type is required',
            'min' => 'The length of the name of the type must have at least 5 caracters',
            'max' => 'The length of the name of the type must have at maximium 30 caracters',
            'exists' => 'The type is not registered',
            'unique' => "The new name '{$name}' is already taken"
        ];
    }
}
