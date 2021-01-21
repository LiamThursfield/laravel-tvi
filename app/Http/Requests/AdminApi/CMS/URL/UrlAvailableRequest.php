<?php

namespace App\Http\Requests\AdminApi\CMS\URL;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UrlAvailableRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'url'       => 'required|string',
            'url_id'    => [
                'sometimes',
                'required',
                'integer',
                Rule::exists('cms_urls', 'id'),
            ]
        ];
    }
}
