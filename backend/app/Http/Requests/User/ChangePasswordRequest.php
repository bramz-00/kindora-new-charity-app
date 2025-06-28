<?php 
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;


class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'Current Password',
            'new_password' => 'New Password',
            'new_password_confirmation' => 'New Password Confirmation',
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
        ];
    }
}