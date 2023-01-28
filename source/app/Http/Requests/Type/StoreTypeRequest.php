<?php

namespace App\Http\Requests\Type;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
            'colors' => [
                'required',
                'array'
            ],
            'disk' => 'required',
            'ram' => 'required',
            'chip' => 'required',
            'pin' => 'required',
            'quantity' => 'nullable',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
        ];
    }

    public function attributes()
    {
        return [
            'color' => 'Màu sản phẩm',
            'disk' => 'Dung lượng bộ nhớ sản phẩm',
            'ram' => 'Ram sản phẩm',
            'chip' => 'Chip sản phẩm',
            'pin' => 'Pin sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'price' => 'Giá sản phẩm',
        ];
    }
}
