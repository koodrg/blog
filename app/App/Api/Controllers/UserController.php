<?php

namespace App\App\Api\Controllers;

use App\App\Api\Requests\UpdateProfileRequest;
use App\Domain\User\Actions\DeleteProfileAction;
use App\Domain\User\Actions\RegisterAction;
use App\Domain\User\Actions\UpdateProfileAction;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        public RegisterAction $registerAction,
        public UpdateProfileAction $updateUserAction,
        public DeleteProfileAction $deleteProfileAction) {
    }

    public function show() {
        return Auth::user();
    }

    public function update(UpdateProfileRequest $request)
    {
        return $this->updateUserAction->handle($request);
    }

    public function delete()
    {
        return $this->deleteProfileAction->handle();
    }
}
