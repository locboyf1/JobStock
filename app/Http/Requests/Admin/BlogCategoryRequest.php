<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
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
            'title' => 'required|string|max:30',
            'description' => 'max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tên danh mục không được để trống',
            'title.string' => 'Tên danh mục phải là văn bản',
            'title.max' => 'Tên danh mục không được quá dài',
            'description.max' => 'Mô tả không được quá dài'
        ];
    }
}
