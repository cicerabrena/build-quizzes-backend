<?php

namespace App\Http\Requests\Api;

use App\Enums\ValidationNumbers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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
                'min:' . ValidationNumbers::MIN_LENGTH_PASSWORD->value
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
            'password.min' => "The password must have at least " . ValidationNumbers::MIN_LENGTH_PASSWORD->value . " caracteres."
        ];
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(validator: $validator, response: response()->json(data: ['errors' => $validator->errors()], status: Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
