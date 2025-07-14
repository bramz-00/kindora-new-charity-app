<?php

namespace App\Http\Requests\Good;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodRequest extends FormRequest
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
            'title' => 'required|string|unique:goods,title|max:255',
            'description' => 'required|string',
            'slug' => 'required|string|unique:goods,slug|max:255',
            'state' => 'in:new,used',
            'type' => 'in:donation,exchange',
            'status' => 'in:available,reserved,unavailable',
            'exchange_condition' => 'nullable|string',
            'owner_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
        ];
    }
}
