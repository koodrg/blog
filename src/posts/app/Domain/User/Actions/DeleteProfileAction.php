<?php

namespace App\Domain\User\Actions;

use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class DeleteProfileAction
{
    public function __construct(public UserRepository $userRepository)
    {
    }

    public function handle()
    {
        $this->userRepository->delete(Auth::id());

        return true;
    }
}
