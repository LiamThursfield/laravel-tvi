<?php

namespace App\Http\Requests\Admin\CMS\Redirect;

use App\Http\Requests\BaseIndexRequest;

class RedirectIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'redirect_is_enabled'   => 'nullable|bool',
            'redirect_is_permanent' => 'nullable|bool',
            'redirect_url_from'     => 'nullable|string',
            'redirect_url_to'       => 'nullable|string',
        ]);
    }
}
