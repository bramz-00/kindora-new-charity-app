<?php

namespace App\Http\Requests\EventTicket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventTicketRequest extends FormRequest
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
            'event_id' => 'sometimes|exists:events,id',
            'name' => 'nullable|string|unique:event_tickets,name,' . $this->route('event_ticket'),
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'sold_count' => 'nullable|integer|min:0',
        ];
    }
}
