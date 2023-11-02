<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'name' => 'nullable',
            'phone' => 'nullable|exists:users,phone',
            'note' => 'nullable',
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'user_id' => 'nullable|exists:users,id',
            'payment_provider' => 'required',
        ];
    }


    public function messages(): array{
        return [
            'payment_provider.required' => 'Vui lòng chọn hình thức thanh toán',
            'phone.exists' => 'Người dùng này chưa phải là khách hàng thành viên'
        ];
    }
}
