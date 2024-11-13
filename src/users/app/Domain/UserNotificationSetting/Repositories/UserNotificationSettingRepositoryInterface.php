<?php

namespace App\Domain\UserNotificationSetting\Repositories;

interface UserNotificationSettingRepositoryInterface {
    public function findByUser($userId);
    public function create(array $data);
    public function delete($userId);
}
