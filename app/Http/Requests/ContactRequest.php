<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:11',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá dài',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá dài',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.max' => 'Số điện thoại không được quá dài',
            'subject.required' => 'Tiêu đề không được để trống',
            'subject.max' => 'Tiêu đề không được quá dài',
            'message.required' => 'Nội dung không được để trống',
        ];
    }
}
