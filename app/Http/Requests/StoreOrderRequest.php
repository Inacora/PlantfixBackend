<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plants' => 'required|array',
            'plants.*.id' => 'required|exists:plants,id',
            'plants.*.quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,cash',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,completed,cancelled',
            'order_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
