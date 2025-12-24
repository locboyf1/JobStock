<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề menu không được để trống.',
            'title.string' => 'Tiêu đề menu phải là một chuỗi ký tự.',
            'title.max' => 'Tiêu đề menu không được quá dài.',
            'description.string' => 'Mô tả menu phải là một chuỗi ký tự.',
            'description.max' => 'Mô tả menu không được quá dài.',
            'url.required' => 'URL menu không được để trống.',
            'url.string' => 'URL menu phải là một chuỗi ký tự.',
            'url.max' => 'URL menu không được quá dài.',
        ];
    }
}
