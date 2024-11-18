<?php

namespace App\App\Http\Controllers\Auth;

use App\App\Http\Controllers\Controller;
use App\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirect to Google for authentication
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
            } else {
                // Create a new user if one doesn't exist
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()), // Generate a random password
                ]);

                Auth::login($user);
            }

            return redirect()->intended('home'); // Redirect to the desired page
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['msg' => 'Google login failed']);
        }
    }

    public function login(Request $request) {
        return view('auth.login');
    }

    public function signIn(Request $request) {

    }
}
