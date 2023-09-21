<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'number' => 'required',
            'complement' => 'nullable',
            'zipcode_id' => 'required|exists:zip_codes,id',
            'entity_id' => 'required|exists:entities,id',
        ];
    }
}