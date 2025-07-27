<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = optional(Auth::user())->id ?? optional($this->user)->id;

        return [
            'last_name' => 'sometimes|required|string|max:255',
            'first_name' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'is_active' => 'nullable|boolean',
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }
}
