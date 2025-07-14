<?php

namespace App\Http\Requests\GoodProposal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoodProposalRequest extends FormRequest
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
            'good_id' => ['sometimes', 'exists:goods,id'],
            'exchange_good_id' => ['nullable', 'exists:goods,id'],
            'status' => ['sometimes', Rule::in(['new', 'accepted', 'rejected'])],
            'reject_reason' => ['nullable', 'string'],
        ];
    }
}
