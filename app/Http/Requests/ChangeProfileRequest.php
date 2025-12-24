<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfileRequest extends FormRequest
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
            'phone' => 'required|max:11',
            'avatar' => 'nullable|image',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.max' => 'Họ và tên không được quá dài',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Số điện thoại không được quá dài',
            'avatar.image' => 'Vui lòng chọn file ảnh',
        ];
    }
}
