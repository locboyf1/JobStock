<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobGroupRequest extends FormRequest
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
            'description' => 'max:500'
        ];
    }

    public function messages(): array
    {
        return[
            'title.required' => 'Tiêu đề không được để trống',
            'title.string' => 'Tiêu đề phải là văn bản',
            'title.max' => 'Tiêu đề không được quá dài',
            'description.max' => 'Mô tả không được quá dài'
        ];
    }
}
