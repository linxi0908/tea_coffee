<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => ['required', 'min:3', 'max:255'],
            'name' => 'required|min:3|max:255|unique:product_categories,name',
            'slug' => 'nullable|string|max:255',
            'status' => 'required',
            'image' => 'image'
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'Tên buộc phải nhập!',
            'name.min' => 'Tên phải trên 3 ký tự',
            'name.max' => 'Tên phải dưới 255 ký tự',
            'name.unique' => 'Tên này đã được chọn!',
            'slug.string' => 'Tên phải là 1 chuỗi.',
            'slug.max' => 'Tên phải dưới 255 ký tự',
            'status.required' => 'Trạng thái phải được chọn!',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
        ];
    }
}
