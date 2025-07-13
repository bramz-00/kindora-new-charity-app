<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'reviewable_type' => 'required|string',
            'reviewable_id'   => 'required|integer|gt:0',
            'comment'         => 'required|string|min:3|max:1000',
            'rating'          => 'required|integer|min:1|max:5',
        ];
    }
}
