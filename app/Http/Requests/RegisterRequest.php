<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:11'
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'name.string' => 'Tên người dùng không hợp lệ',
            'name.max' => 'Tên người dùng không được vượt quá 100 ký tự',
            'email.required' => 'Vui lòng nhập email đăng nhập',
            'email.string' => 'Email đăng nhập không hợp lệ',
            'email.email' => 'Email đăng nhập không đúng định dạng',
            'email.max' => 'Email đăng nhập không được vượt quá 50 ký tự',
            'email.unique' => 'Email đăng nhập đã tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.string' => 'Số điện thoại không hợp lệ',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu không hợp lệ'
        ];
    }
}
