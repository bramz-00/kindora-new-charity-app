<?php

namespace App\Http\Requests\GoodProposal;

use App\Models\Good;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'good_id' => ['required', 'exists:goods,id'],
            'user_id' => ['required', 'exists:users,id'],
            'exchange_good_id' => ['nullable', 'exists:goods,id'],
        ];
    }
        public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $good = Good::find($this->good_id);

            if ($good && $good->type === 'exchange' && empty($this->exchange_good_id)) {
                $validator->errors()->add('exchange_good_id', 'Exchange good is required when the selected good is of type exchange.');
            }
        });
    }
}
