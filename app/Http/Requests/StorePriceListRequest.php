<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceListRequest extends FormRequest
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
            'price' => 'required|numeric',
            'isAvailable' => 'required|boolean',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
        ];
    }
}