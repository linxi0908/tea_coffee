<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user,
            'role_id' => 'required',
        ];
    }
    public function messages():array {
        return [
            'name.required' => 'Tên buộc phải nhập!',
            'email.required' => 'Email buộc phải nhập !',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được sử dụng!',
            'role_id.required' => 'Vai trò phải được chọn!',
        ];
    }
}
