<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformationRequest extends FormRequest
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
            'email' => 'nullable|email|max:255',
            'hotline' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'zalo' => 'nullable|max:255',
            'chatzalo' => 'nullable|max:255',
            'website' => 'nullable|max:255',
            'fanpage' => 'nullable|max:255',
            'chatfacebook' => 'nullable|max:255',
            'googlemap' => 'nullable|max:255',
            'googleiframe' => 'nullable',
        ];
    }
}
