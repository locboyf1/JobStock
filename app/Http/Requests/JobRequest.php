<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required|max:200',
            'description' => 'required|max:5000',
            'job_type_id' => 'required',
            'job_id' => 'required',
            'salary_min' => 'required|integer|min:0',
            'salary_max' => 'nullable|integer|gt:salary_min',
            'experience' => 'required|integer|min:0',
            'quantity' => 'required',
            'content' => 'required',
            'expiredTime' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.max' => 'Tiêu đề không được quá dài',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.max' => 'Mô tả không được quá dài',
            'job_type_id.required' => 'Vui lòng chọn loại hình tuyển dụng',
            'job_id.required' => 'Vui lòng chọn ngành tuyển dụng',
            'salary_min.required' => 'Vui lòng nhập lương tối thiểu',
            'salary_min.integer' => 'Lương tối thiểu phải là số',
            'salary_min.min' => 'Lương tối thiểu phải lớn hơn 0',
            'salary_max.integer' => 'Lương tối đa phải là số',
            'salary_max.gt' => 'Lương tối đa phải lớn hơn lương tối thiểu',
            'experience.required' => 'Vui lòng nhập năm kinh nghiệm',
            'quantity.required' => 'Vui lòng nhập số lượng tuyển',
            'expiredTime.required' => 'Vui lòng chọn ngày hết hạn',
            'expiredTime.date' => 'Ngày hết hạn phải là ngày',
            'expiredTime.after' => 'Ngày hết hạn phải sau ngày hôm nay',
            'experience.integer' => 'Năm kinh nghiệm phải là số',
            'experience.min' => 'Năm kinh nghiệm phải từ 0 trở lên',
            'content.required' => 'Vui lòng nhập nội dung',
        ];
    }
}
