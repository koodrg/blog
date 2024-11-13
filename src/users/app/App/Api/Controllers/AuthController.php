<?php

namespace App\App\Api\Controllers;

use App\App\Api\Requests\RegisterRequest;
use App\Domain\User\Actions\LoginAction;
use App\Domain\User\Actions\RegisterAction;
use App\Domain\User\Actions\VerifyEmailAction;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        public LoginAction $loginAction,
        public RegisterAction $registerAction,
        public VerifyEmailAction $verifyEmailAction
    )
    {
    }

    public function login(Request $request)
    {
        $user = $this->loginAction->handle($request);

        if($user) {
            return response()->json([
                'user' => $user
            ]);
        }

        return response()->json([
            'error' => 'USER_NOT_FOUND',
        ], 404);
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerAction->handle($request);
    }

    public function verifyEmail(Request $request)
    {
        return $this->verifyEmailAction->handle();
    }
}
