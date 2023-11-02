<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
        'current_password' => ['required','current_password'],
        'password' => ['required', 'min: 8', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'Mật khẩu hiện tại buộc phải nhập!',
            'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',
            'password.required' => 'Mật khẩu mới buộc phải nhập!',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Nhập lại mật khẩu không đúng.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $validated = $validator->validated();
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        session()->flash('message', 'Mật khẩu đã được cập nhật thành công.');
        return back()->with('status', 'password-updated');
    }
}
