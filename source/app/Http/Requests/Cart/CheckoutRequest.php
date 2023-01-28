<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name_receiver' => [
                'required',
                'max:255',
            ],
            'phone_receiver' => [
                'required',
                'max:255',
            ],
            'address_receiver' => [
                'required',
                'max:255',
            ],
            'note' => [
                'max:255',
            ],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'max' => ':attribute tối đa :max kí tự'
        ];
    }

    public function attributes()
    {
        return [
            'name_receiver' => 'Tên người nhận',
            'phone_receiver' => 'Số điện thoại',
            'address_receiver' => 'Địa chỉ',
            'note' => 'Ghi chú'
        ];
    }
}
