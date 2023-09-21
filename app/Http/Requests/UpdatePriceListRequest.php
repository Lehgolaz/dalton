<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceListRequest extends FormRequest
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
            'price' => 'sometimes|required|numeric',
            'isAvailable' => 'sometimes|required|boolean',
            'store_id' => 'sometimes|required|exists:stores,id',
            'product_id' => 'sometimes|required|exists:products,id',
        ];
    }
}