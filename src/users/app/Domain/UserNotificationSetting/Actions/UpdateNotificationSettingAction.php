<?php

namespace App\Domain\UserNotificationSetting\Actions;

use App\App\Api\Requests\UpdateNotificationSettingsRequest;
use App\Constant\NotificationSettings;
use App\Domain\UserNotificationSetting\Repositories\UserNotificationSettingRepositoryInterface as RepositoriesUserNotificationSettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UpdateNotificationSettingAction
{
    public function __construct(public RepositoriesUserNotificationSettingRepositoryInterface $repository)
    {

    }

    public function handle(UpdateNotificationSettingsRequest $request)
    {
        $userId = Auth::id();
        $data = [];

        if($request->notification_new_post)
        {
            $data[] = [
                'user_id' => $userId,
                'type' => NotificationSettings::NEW_POST_NOTIFICATION
            ];
        }

        if($request->notification_comment)
        {
            $data[] = [
                'user_id' => $userId,
                'type' => NotificationSettings::COMMENT_NOTIFICATION
            ];
        }

        if($request->notification_like)
        {
            $data[] = [
                'user_id' => $userId,
                'type' => NotificationSettings::LIKE_NOTIFICATION
            ];
        }

        if($request->notification_follow)
        {
            $data[] = [
                'user_id' => $userId,
                'type' => NotificationSettings::NEW_FOLLOW_NOTIFICATION
            ];
        }

        $this->repository->delete($userId);
        $this->repository->create($data);

        return true;
    }
}
