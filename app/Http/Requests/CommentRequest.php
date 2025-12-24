<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Nội dung bình luận không được để trống',
            'content.max' => 'Nội dung bình luận không được quá dài',
        ];
    }
}
