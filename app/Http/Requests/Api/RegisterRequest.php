<?php

namespace App\Http\Requests\Api;

use App\Enums\ValidationNumbers;
use App\Enums\ValidationError;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class RegisterRequest extends FormRequest
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
                'min:' . ValidationNumbers::MIN_LENGTH_NAME->value
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
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
            'name.required' => 'The name is required.',
            'name.string' => 'The name must have only ....',
            'name.min' => "The name must have at least " . ValidationNumbers::MIN_LENGTH_NAME->value . " caracteres.",
            'email.required' => 'The e-mail is required.',
            'email.email' => 'The e-mail is not valid.',
            'email.unique' => ValidationError::EMAIL_ALREADY_REGISTERED->value,
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
