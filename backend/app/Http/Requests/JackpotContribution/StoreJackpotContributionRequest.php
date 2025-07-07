<?php

namespace App\Http\Requests\JackpotContribution;

use Illuminate\Foundation\Http\FormRequest;

class StoreJackpotContributionRequest extends FormRequest
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
            'jackpot_id' => 'required|exists:jackpots,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ];
    }
}
