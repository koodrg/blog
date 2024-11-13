<?php

namespace App\App\Api\Requests;

use App\App\Api\Requests\Common\BaseRequest;

class UpdateNotificationSettingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'notification_new_post' => 'required|bool',
            'notification_comment' => 'required|bool',
            'notification_like' => 'required|bool',
            'notification_follow' => 'required|bool',
        ];
    }
}
