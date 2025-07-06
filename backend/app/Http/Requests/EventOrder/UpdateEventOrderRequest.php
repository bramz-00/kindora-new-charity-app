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
            'organisation_id' => 'sometimes|exists:organisations,id',
            'created_by_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|string|max:255|unique:events,title,' . $this->route('event')->id,
            'description' => 'sometimes|string',
            'location' => 'sometimes|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'target_amount' => 'nullable|numeric|min:0',
            'status' => 'in:open,closed',
            'type' => 'in:public,private',
            'is_active' => 'boolean',
        ];
    }
}
