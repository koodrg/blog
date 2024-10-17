<?php

namespace App\Domain\User\Actions;

use App\App\Api\Requests\UpdateProfileRequest;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UpdateProfileAction
{
    public function __construct(public UserRepository $userRepository)
    {

    }

    public function handle(UpdateProfileRequest $request)
    {
        $data = $request->only('name');

        $result = $this->userRepository->update(Auth::id(), $data);

        return $result;
    }
}
