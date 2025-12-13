<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostReportRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'email' => 'required|email|max:50',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Tên không được nhập quá dài',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.max' => 'Tiêu đề không được nhập quá dài',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'content.required' => 'Vui lòng nhập nội dung',
            'content.string' => 'Nội dung phải là chuỗi',
        ];
    }
}
