<?php

namespace App\Http\Requests\EventOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_ticket_id' => 'required|exists:event_tickets,id',
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'nullable|string|in:pending,paid,cancelled',
            'payment_method' => 'nullable|string|in:online,cash',
            'purchased_at' => 'nullable|date',
        ];
    }
}
