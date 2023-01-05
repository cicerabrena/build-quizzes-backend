<?php

namespace App\Http\Requests\Api\User;

use App\Enums\Constants;
use Illuminate\Foundation\Http\FormRequest;

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
                'min:' . Constants::MIN_LENGTH_NAME->value
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'min:' . Constants::MIN_LENGTH_PASSWORD->value
            ]

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must have only ....',
            'name.min' => "The name must have at least " . Constants::MIN_LENGTH_NAME->value . " caracteres.",
            'email.required' => 'The e-mail is required.',
            'email.email' => 'The e-mail is not valid.',
            'password.required' => 'The password is required.',
            'password.min' => "The password must have at least " . Constants::MIN_LENGTH_PASSWORD->value . " caracteres."
        ];
    }
}
