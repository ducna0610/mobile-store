<?php

namespace App\Http\Requests\Bill;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RateProductRequest extends FormRequest
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
            'star' => [
                'required',
                Rule::in([1, 2, 3, 4, 5]),
            ],
            'comment' => [
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
        ];
    }

    public function attributes()
    {
        return [
            'star' => 'Số sao',
            'comment' => 'Bình luận',
        ];
    }
}
