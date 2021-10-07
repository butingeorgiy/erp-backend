<?php

namespace App\Http\Requests\Authentication;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['type_id' => "string"])]
    public function rules(): array
    {
        return [
            'type_id' => 'required|numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ApiValidationException($validator);
    }
}
