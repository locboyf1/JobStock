<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
        $companyId = $this->route('id');

        return [
            'tax_code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('companies', 'tax_code')->ignore($companyId),
            ],
            'phone' => 'required|string|max:11',
            'email' => 'required|string|email|max:50',
            'title' => 'required|string|max:100',
            'province_id' => 'required|integer',
            'address' => 'required|string|max:300',
            'description' => 'required|string|max:5000',
            'content' => 'required|array',
            'website' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'pinterest' => 'nullable|max:255',
            'youtube' => 'nullable|max:255',
            'wikipedia' => 'nullable|max:255',
            'linkedin' => 'nullable|max:255',
            'shop' => 'nullable|max:255',
            'confirm_updated_image' => 'required|image',
            'accept' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'tax_code.required' => 'Vui lòng nhập mã số thuế',
            'tax_code.string' => 'Mã số thuế không hợp lệ',
            'tax_code.max' => 'Mã số thuế không được vượt quá 20 ký tự',
            'tax_code.unique' => 'Mã số thuế đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.string' => 'Số điện thoại không hợp lệ',
            'phone.max' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Vui lòng nhập email',
            'email.string' => 'Email không hợp lệ',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá dài ',
            'title.required' => 'Vui lòng nhập tên công ty',
            'title.string' => 'Tên công ty không hợp lệ',
            'title.max' => 'Tên công ty không được quá dài',
            'province_id.required' => 'Vui lòng chọn tỉnh thành',
            'province_id.integer' => 'Tỉnh thành không hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ chi tiết',
            'address.string' => 'Địa chỉ chi tiết không hợp lệ',
            'address.max' => 'Địa chỉ chi tiết không được quá dài',
            'description.required' => 'Vui lòng nhập mô tả công ty',
            'description.string' => 'Mô tả công ty không hợp lệ',
            'description.max' => 'Mô tả công ty không được quá dài',
            'content.required' => 'Vui lòng thêm ít nhất một khối nội dung công ty',
            'website.max' => 'Đường dẫn không được quá dài',
            'facebook.max' => 'Đường dẫn không được quá dài',
            'pinterest.max' => 'Đường dẫn không được quá dài',
            'youtube.max' => 'Đường dẫn không được quá dài',
            'wikipedia.max' => 'Đường dẫn không được quá dài',
            'linkedin.max' => 'Đường dẫn không được quá dài',
            'shop.max' => 'Đường dẫn không được quá dài',
            'logo.image' => 'Ảnh logo không hợp lệ',
            'confirm_image.image' => 'Ảnh xác nhận không hợp lệ',
            'confirm_image.required' => 'Vui lòng chọn ảnh xác nhận',
            'accept.required' => 'Vui lòng đồng ý với điều khoản sử dụng',
            'accept.boolean' => 'Vui lòng đồng ý với điều khoản sử dụng',
        ];
    }
}
