<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function loginToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callbackFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $user = Customer::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24)),
            'email_verified_at' => now()
        ]);
        Auth::login($user, true);
        return redirect('/home');
    }
}
