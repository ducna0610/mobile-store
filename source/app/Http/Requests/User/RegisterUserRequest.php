<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
                'unique:users',
            ],
            'gender' => [
                'required',
                'boolean',
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
                'min:8',
                'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
                'confirmed',
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
            'confirmed' => ':attribute không khớp',
        ];
    }

    public function attributes()
    {
        return  [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu',
        ];
    }
}
