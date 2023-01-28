<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => [
                'email',
                'required',
            ],
            'password' => [
                'required'
            ]
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'email' => ':attribute không đúng định dạng',
        ];
    }

    public function attributes()
    {
        return  [
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }
}
