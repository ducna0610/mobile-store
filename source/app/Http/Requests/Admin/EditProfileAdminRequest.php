<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dob' => [
                'required',
                'date_format:"Y-m-d"',
                'before:tomorrow'
            ],
            'phone' => [
                'required',
                'regex:/^0\d{9}$/',
            ],
            'address' => [
                'required',
                'max:255',
            ]
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'max' => ':attribute chứa tối đa :max kí tự',
            'regex' => ':attribute không hợp lệ',
            'date_format' => ':attribute không hợp lệ',
            'before' => 'Xin lỗi hệ thống chưa hỗ trợ người đến từ tương lai!'
        ];
    }

    public function attributes()
    {
        return  [
            'dob' => 'Ngày sinh',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
    }
}
