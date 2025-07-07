<?php

namespace App\Http\Requests\EventOrder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventOrderRequest extends FormRequest
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
            'status' => 'sometimes|string|in:pending,paid,cancelled',
            'payment_method' => 'sometimes|string|in:online,cash',
            'purchased_at' => 'nullable|date',  
        ];
    }
}
