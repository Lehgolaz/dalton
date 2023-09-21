<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'number' => 'sometimes|required',
            'complement' => 'nullable',
            'zipcode_id' => 'sometimes|required|exists:zip_codes,id',
            'entity_id' => 'sometimes|required|exists:entities,id',
        ];
    }
}