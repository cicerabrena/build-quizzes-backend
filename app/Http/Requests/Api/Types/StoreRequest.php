<?php

namespace App\Http\Requests\Api\Types;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:30',
                'unique:types,name'
            ]
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'required' => 'The name of the type is required',
            'min' => 'The length of the name of the type must have at least 5 caracters',
            'max' => 'The length of the name of the type must have at maximium 30 caracters',
            'unique' => 'The name of the type is already taken'
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
