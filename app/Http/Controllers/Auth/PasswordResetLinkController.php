<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Information;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $informations = Information::get();
        $contacts = Contact::get();
        return view('client.pages.forgot_password.forgot_password',[
            'informations' => $informations,
            'contacts' => $contacts
            ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
        ]);

        $email = $request->input('email');

        // Kiểm tra xem địa chỉ email đã tồn tại trong cơ sở dữ liệu hay chưa
        $emailExists = User::where('email', $email)->exists();

        if (!$emailExists) {
            return back()->withErrors(['email' => 'Địa chỉ email không tồn tại.']);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        $message = 'Vui lòng kiểm tra email của bạn';
        return $status == Password::RESET_LINK_SENT
                    ? back()->with(['status', __($status),
                    'message' => $message])
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
