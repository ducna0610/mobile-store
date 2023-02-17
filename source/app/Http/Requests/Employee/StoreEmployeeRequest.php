<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => [
                'required',
                'min:2',
                'max:50'
            ],
            'email' => [
                'email',
                'required',
                'max:255',
                'unique:admins',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'dob' => [
                'required',
                'date_format:"Y-m-d"',
                'before:tomorrow'
            ],
            'phone' => [
                'nullable',
                'regex:/^0\d{9}$/',
            ],
            'address' => [
                'nullable',
                'max:255',
            ],
            'password' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'unique' => ':attribute đã có tài khoản',
            'min' => ':attribute cần ít nhât :min kí tự',
            'max' => ':attribute chứa tối đa :max kí tự',
            'email' => ':attribute không hợp lệ',
            'regex' => ':attribute không hợp lệ',
            'date_format' => ':attribute không hợp lệ',
            'before' => 'Xin lỗi hệ thống chưa hỗ trợ người đến từ tương lai!'
        ];
    }

    public function attributes()
    {
        return  [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'gender' => 'Giới tính',
            'dob' => 'Ngày sinh',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu',
        ];
    }
}
