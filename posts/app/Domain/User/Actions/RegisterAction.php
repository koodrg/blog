<?php

namespace App\Domain\User\Actions;

use App\App\Api\Requests\RegisterRequest;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function __construct(public UserRepository $userRepository)
    {

    }

    public function handle(RegisterRequest $request)
    {
        $data = $request->input();

        $user = $this->userRepository->findByEmail($data['email']);

        if($user) {
            return response()->json([
                'error' => "EMAIL_EXISTS",
            ]);
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);
        //todo: send mail verify

        return response()->json([
            'user' => $user,
        ], 200);
    }
}
