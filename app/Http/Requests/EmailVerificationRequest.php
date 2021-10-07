<?php

namespace App\Http\Requests;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EmailVerificationRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'uuid' => "string",
        'salt' => "string"
    ])]
    public function rules(): array
    {
        return [
            'uuid' => 'required|uuid',
            'salt' => 'required|string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ApiValidationException($validator);
    }
}
