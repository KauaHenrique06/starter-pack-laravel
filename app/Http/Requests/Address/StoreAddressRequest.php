<?php

namespace App\Http\Requests\Address;

use App\Rules\ValidCpfRule;
use App\Rules\ValidZipCodeRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'number' => [
                'required',
                'integer'
            ],
            'reference' => [
                'string',
                'nullable',
                'max:255'
            ],
            'complement' => [
                'nullable',
                'string',
                'max:255'
            ],
            'zip_code' => [
                'required',
                'string',
                new ValidZipCodeRule
            ],

        ];
    }
}
