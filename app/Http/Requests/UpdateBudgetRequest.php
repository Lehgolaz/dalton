<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetDetailRequest extends FormRequest
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
            'amount' => 'sometimes|required|numeric',
            'price' => 'sometimes|required|numeric',
            'discount' => 'sometimes|nullable|numeric',
            'subtotal' => 'sometimes|required|numeric',
            'budget_id' => 'sometimes|required|exists:budgets,id',
            'price_list_id' => 'sometimes|required|exists:price_lists,id',
        ];
    }
}