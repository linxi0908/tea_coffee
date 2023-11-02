<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:products,name,'.$this->product,
            'slug' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'image',
            'status' => 'required',
            'featured' => 'required',
            'product_category_id' =>'required'
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'Tên buộc phải nhập!',
            'name.string' => 'Tên phải là 1 chuỗi.',
            'name.unique' => 'Tên này đã được chọn!',
            'name.max' => 'Tên phải dưới 255 ký tự',
            'slug.string' => 'Tên phải là 1 chuỗi.',
            'slug.max' => 'Tên phải dưới 255 ký tự',
            'price.required' => 'Giá buộc phải nhập!',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải lớn 0.',
            'discount_price.required' => 'Giá buộc phải nhập!',
            'discount_price.numeric' => 'Giá phải là số.',
            'discount_price.min' => 'Giá phải lớn 0.',
            'description.string' => 'Mô tả phải là 1 chuỗi.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'status.required' => 'Trạng thái phải được chọn!',
            'featured.required' => 'Trạng thái phải được chọn!',
            'product_category_id.required' => 'Loại sản phẩm phải được chọn!',
        ];
    }
}
