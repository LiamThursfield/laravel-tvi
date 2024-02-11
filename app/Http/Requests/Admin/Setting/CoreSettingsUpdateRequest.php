<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;
use App\Interfaces\LocaleInterface;
use Illuminate\Validation\Rule;

class CoreSettingsUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'locale' => [
                'required',
                Rule::in(array_keys(LocaleInterface::ALL_LOCALES))
            ],
        ];
    }
}
