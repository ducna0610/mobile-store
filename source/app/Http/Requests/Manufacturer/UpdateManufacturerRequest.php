<?php

namespace App\Http\Requests\Manufacturer;

use App\Models\Manufacturer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateManufacturerRequest extends FormRequest
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
                'required',
                Rule::unique('Manufacturers')->ignore($this->manufacturer),
            ],
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'unique' => ':attribute đã tồn tại',
            'email' => 'Phải là email',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên nsx',
            'email' => 'Email nsx',
            'phone' => 'Số điện thoại nsx',
            'address' => 'Địa chỉ nsx',
        ];
    }
}
