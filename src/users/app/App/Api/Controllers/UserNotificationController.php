<?php

namespace App\App\Api\Controllers;

use App\App\Api\Requests\UpdateNotificationSettingsRequest;
use App\Domain\UserNotificationSetting\Actions\UpdateNotificationSettingAction as ActionsUpdateNotificationSettingAction;

class UserNotificationController extends Controller
{
    public function __construct(public ActionsUpdateNotificationSettingAction $action) {
    }

    public function update(UpdateNotificationSettingsRequest $request)
    {
        return $this->action->handle($request);
    }
}
