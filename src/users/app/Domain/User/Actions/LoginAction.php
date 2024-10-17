<?php

namespace App\Domain\User\Actions;

use App\Infrastructure\Helpers\JwtHelper;
use App\Infrastructure\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function handle(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $this->generateJwtToken($user);
            $user->token = $token;

            return $user;
        }

        return null;
    }

    private function generateJwtToken(User $user)
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $payload = [
            'sub' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'iat' => Carbon::now()->timestamp,
            'exp' => Carbon::now()->addMonth()->timestamp,
        ];

        $secret = env('JWT_SECRET_KEY');

        return JwtHelper::generateJwt($header, $payload, $secret);
    }
}
