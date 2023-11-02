<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Information;
use App\Models\ProductCategory;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $contacts = Contact::get();
        $informations = Information::get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart')?? [];
        return view('client.pages.register.register', [
            'productCategories'=>$productCategories,
            'contacts' => $contacts,
            'cart' => $cart,
            'informations' => $informations
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'numeric','digits:10', 'unique:'.User::class],
            'password' => ['required','min:8', 'confirmed', Rules\Password::defaults()],
        ],[
            'name.required' => 'Tên buộc phải nhập !',
            'email.required' => 'Email buộc phải nhập!',
            'email.email' => 'Địa chỉ email không hợp lệ!',
            'email.unique' => 'Email đã được sử dụng!',
            'phone.required' => 'Số điện thoại buộc phải nhập!',
            'phone.numeric' => 'Số điện thoại phải là số!',
            'phone.digits' => 'Số điện thoại phải dài 10 số!',
            'phone.unique' => 'Số điện thoại đã được sử dung!',
            'password.required' => 'Mật khẩu buộc phải nhập!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        $message = "Đăng ký tài khoản thành công.";
        return redirect(RouteServiceProvider::PROFILE)->with('message', $message);
    }
}
