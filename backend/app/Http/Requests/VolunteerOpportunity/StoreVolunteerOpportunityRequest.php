<?php

namespace App\Http\Requests\VolunteerOpportunity;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerOpportunityRequest extends FormRequest
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
            'organisation_id' => 'required|exists:organisations,id',
            'created_by_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255|unique:volunteer_opportunities,title',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:open,closed',
            'is_active' => 'boolean',
        ];
    }
}
