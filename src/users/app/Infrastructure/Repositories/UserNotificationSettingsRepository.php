<?php

namespace App\Infrastructure\Repositories;

use App\Domain\UserNotificationSetting\Repositories\UserNotificationSettingRepositoryInterface;
use App\Infrastructure\Models\UserNotificationSetting;
use App\Infrastructure\Repositories\Common\BaseRepository;

class UserNotificationSettingsRepository extends BaseRepository implements UserNotificationSettingRepositoryInterface
{
    public function __construct(UserNotificationSetting $model)
    {
        $this->model = $model;
    }

    public function delete($userId)
    {
        return UserNotificationSetting::where('user_id', $userId)->delete();
    }

    public function create($data)
    {
        return UserNotificationSetting::insert($data);
    }

    public function findByUser($userId)
    {
        return UserNotificationSetting::where('user_id', $userId)->get();
    }
}
