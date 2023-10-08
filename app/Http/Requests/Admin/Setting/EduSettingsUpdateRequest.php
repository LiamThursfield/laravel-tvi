<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;

class EduSettingsUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'course_checkout_success_url' => 'nullable|string',
            'course_checkout_cancel_url' => 'nullable|string',
        ];
    }
}