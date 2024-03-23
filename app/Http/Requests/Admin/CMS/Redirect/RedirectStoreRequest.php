<?php

namespace App\Http\Requests\Admin\CMS\Redirect;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class RedirectStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'url_from'      => [
                'required',
                'string',
                'starts_with:/',
                Rule::unique('cms_redirects')
            ],
            'url_to'        => 'required|string|starts_with:/',
            'is_enabled'    => 'required|boolean',
            'is_permanent'  => 'required|boolean',
            'published_at'  => 'nullable|date',
            'expired_at'    => 'nullable|date',
        ];
    }
}
