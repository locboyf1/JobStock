<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:50|exists:users,email',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email đăng nhập',
            'email.string' => 'Email đăng nhập không hợp lệ',
            'email.email' => 'Email đăng nhập không đúng định dạng',
            'email.max' => 'Email đăng nhập không được vượt quá 50 ký tự',
            'email.exists' => 'Email đăng nhập không tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu không hợp lệ'
        ];
    }
}
