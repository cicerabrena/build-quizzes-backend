<?php

namespace App\Http\Requests\Api\Auth;

use App\Enums\ValidationError;
use Illuminate\Foundation\Http\FormRequest;

class RevokeRequest extends FormRequest
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
            'token' => [
                'required',
                'exists:personal_access_tokens,id'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'The token is required.',
            'token.exists' => ValidationError::TOKEN_INVALID->value
        ];
    }
}
