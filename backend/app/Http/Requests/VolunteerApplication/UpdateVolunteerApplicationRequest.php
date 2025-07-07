<?php

namespace App\Http\Requests\VolunteerApplication;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVolunteerApplicationRequest extends FormRequest
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
            'volunteer_opportunity_id' => 'sometimes|exists:volunteer_opportunities,id',
            'user_id' => 'sometimes|exists:users,id',
        ];
    }
}
