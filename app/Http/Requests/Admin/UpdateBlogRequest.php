<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'max:5000',
            'content' => 'required|string|max:1000000',
            'blog_category_id' => 'required|integer',
            'image' => 'image'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.string' => 'Tiêu đề phải là văn bản',
            'title.max' => 'Tiêu đề không được quá dài',
            'description.max' => 'Mô tả không được quá dài',
            'content.required' => 'Nội dung không được để trống',
            'content.string' => 'Nội dung phải là văn bản',
            'content.max' => 'Nội dung không được quá dài',
            'blog_category_id.required' => 'Danh mục không được để trống',
            'blog_category_id.integer' => 'Mã danh mục phải là số nguyên',
            'image.image' => 'Hình ảnh không đúng định dạng'
        ];
    }
}
