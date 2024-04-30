<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;

class ThemeSettingsUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'colors'       => 'nullable|array',
            'favicon_url'   => 'nullable|string',
            'logo_url'      => 'nullable|string',
            'site_name'     => 'nullable|string',
        ];
    }
}
