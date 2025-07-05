<?php

namespace App\Http\Requests\Jackpot;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJackpotRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255|unique:jackpots,title,' . $this->route('jackpot')->id,
            'description' => 'sometimes|string',
            'target_amount' => 'sometimes|numeric|min:0',
            'collected_amount' => 'sometimes|numeric|min:0',
            'start_date' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:open,closed',
            'is_active' => 'boolean',
        ];
    }
}
