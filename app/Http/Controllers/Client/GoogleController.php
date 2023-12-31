<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'google_user_id' => $googleUser->getId(),
                'password' => Hash::make('password' . '@' . $googleUser->getId()),
            ]
        );

        if($user->wasRecentlyCreated){
            $message = "Đăng ký tài khoản thành công.";
        }
        else{
            $message = "Đăng nhập thành công.";
        }
        Auth::login($user);
        return redirect()->route('profile.edit')->with('message', $message);
    }
}
