<?php

namespace App\Http\Requests\Api;

use App\Enums\Constants;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'exists:users,email'
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
            'email.required' => 'The e-mail is required.',
            'email.email' => 'The e-mail is not valid.',
            'email.exists' => 'The e-mail is not registered.',
            'password.required' => 'The password is required.',
            'password.min' => "The password must have at least " . Constants::MIN_LENGTH_PASSWORD->value . " caracteres."
        ];
    }
}
