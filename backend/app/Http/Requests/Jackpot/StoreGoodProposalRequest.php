<?php

namespace App\Http\Requests\GoodProposal;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodProposalRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:jackpots,title',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'collected_amount' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:open,closed',
            'is_active' => 'boolean',
        ];
    }
}
