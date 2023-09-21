<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetRequest extends FormRequest
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
            'budget_date' => 'sometimes|required|date',
            'expiration_date' => 'sometimes|required|date',
            'delivery_date' => 'sometimes|required|date',
            'shipping_value' => 'sometimes|required|numeric',
            'address_id' => 'sometimes|required|exists:addresses,id',
            'budget_type_id' => 'sometimes|required|exists:budget_types,id',
        ];
    }
}