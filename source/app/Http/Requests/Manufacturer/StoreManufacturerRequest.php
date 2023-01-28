<?php

namespace App\Http\Requests\Manufacturer;

use Illuminate\Foundation\Http\FormRequest;

class StoreManufacturerRequest extends FormRequest
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
            'name' =>
            [
                'bail',
                'required',
                'unique:manufacturers',
            ],
            'logo' =>
            [
                'required',
                'file',
                'image',
            ],
            'email' =>
            [
                'required',
                'email',
            ],
            'phone' =>
            [
                'required',
            ],
            'address' =>
            [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'unique' => ':attribute đã tồn tại',
            'images' => ':attribute phải có đuôi .png hoặc .jpg',
            'email' => ':attribute không đúng định dạng',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên nsx',
            'logo' => 'Logo nsx',
            'email' => 'Email nsx',
            'phone' => 'Số điện thoại nsx',
            'address' => 'Địa chỉ nsx',
        ];
    }
}
