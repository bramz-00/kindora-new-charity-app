<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganisationRequest extends FormRequest
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
            'name' => 'required|string|unique:organisations,name,' . $this->organisation,
            'registration_date' => 'nullable|date',
            'registration_number' => 'required|string|unique:organisations,registration_number,' . $this->organisation,
            'email' => 'required|email|unique:organisations,email,' .  $this->organisation,
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'country' => 'nullable|string',
            'legal_status' => 'nullable|string',
            'verified' => 'boolean',
            'is_active' => 'boolean',
            'president_id' => 'required|exists:users,id',
        ];
    }
}
