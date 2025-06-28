<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;


class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'email' => 'required|email|string|max:500|unique:users,email,'.$this->user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birth_date' => 'Date of Birth',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('first_name') && $this->has('last_name')) {
            $this->merge([
                'name' => $this->first_name . ' ' . $this->last_name
            ]);
        }
    }
}