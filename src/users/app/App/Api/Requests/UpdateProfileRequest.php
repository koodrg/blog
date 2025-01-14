<?php

namespace App\App\Api\Requests;

use App\App\Api\Requests\Common\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|max:255',
            'password' => 'required|string|min:6|confirmed', //password, password_confirmation
        ];
    }
}
