<?php

namespace App\Http\Requests\Registration;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterPhysicRecruiterRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'first_name' => "string",
        'last_name' => "string",
        'city_id' => "string",
        'email' => "string",
        'email_confirmation' => "string",
        'password' => "string",
        'password_confirmation' => "string"
    ])]
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city_id' => 'required|numeric|exists:cities,id',
            'email' => 'required|email|confirmed|unique:users',
            'email_confirmation' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ApiValidationException($validator);
    }
}
