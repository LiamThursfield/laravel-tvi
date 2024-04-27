<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;

class ThirdPartySettingsUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'gtm_id' => 'nullable|string',
            'mailer' => 'nullable|array',
            'stripe_publishable_key' => 'nullable|string',
            'stripe_secret_key' => 'nullable|string',
        ];
    }
}
