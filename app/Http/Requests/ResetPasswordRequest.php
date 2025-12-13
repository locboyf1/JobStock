<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'otp' => 'required|numeric|digits:6',
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'Mã OTP là bắt buộc',
            'otp.numeric' => 'Mã OTP phải là số',
            'otp.digits:6' => 'Mã OTP phải có 6 chữ số',
        ];
    }
}
