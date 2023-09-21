<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetDetailRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'budget_id' => 'required|exists:budgets,id',
            'price_list_id' => 'required|exists:price_lists,id',
        ];
    }
}