<?php

namespace App\Http\Requests\Product;

use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products',
            'image' => 'required|file|image',
            'description' => 'required',
            'manufacturer_id' => [
                'required',
                Rule::exists(Manufacturer::class, 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc điền',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute phải có đuôi .png hoặc .jpg',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'image' => 'Ảnh sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'manufacturer_id' => 'Nhà sản xuất',
        ];
    }
}
