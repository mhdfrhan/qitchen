<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $this->loginExistingUser($user);
            } else {
                $user = $this->registerNewUser($googleUser);
            }

            Auth::login($user);

            return redirect()->route('home.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to login with Google, please try again.');
        }
    }

    private function loginExistingUser($user)
    {
        $googleUser = Socialite::driver('google')->user();

        $user->update([
            'name' => $googleUser->getName(),
        ]);

        return $user;
    }

    private function registerNewUser($googleUser)
    {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Str::password(12),
            'google_id' => $googleUser->getId(),
            'role' => 'user',
        ]);

        return $user;
    }
}
