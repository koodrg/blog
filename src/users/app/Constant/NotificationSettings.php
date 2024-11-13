<?php

namespace App\Constant;

enum NotificationSettings: string {
    case COMMENT_NOTIFICATION = 'comment_notification';
    case LIKE_NOTIFICATION = 'like_notification';
    case NEW_FOLLOW_NOTIFICATION = 'new_follow_notification';
    case NEW_POST_NOTIFICATION = 'new_post_notification';
}
