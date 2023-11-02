<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
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
            'name' => 'required|max:255',
            'district' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|digits:10',
            'note' => 'nullable',
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'user_id' => 'nullable|exists:users,id',
            'payment_provider' => 'required'
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Vui lòng nhập tên',
            'district.required' => 'Vui lòng nhập quận',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.digits' => 'Số điện thoại phải 10 số',
            'payment_provider.required' => 'Vui lòng chọn hình thức thanh toán'
        ];
    }
}
