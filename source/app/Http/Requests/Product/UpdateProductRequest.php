<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
                Rule::unique('Products')->ignore($this->product),
            ],
            'description' => 'required',
            'manufacturer_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'unique' => ':attribute đã tồn tại'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
        ];
    }
}
