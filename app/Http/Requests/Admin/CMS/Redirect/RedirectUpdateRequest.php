<?php

namespace App\Http\Requests\Admin\CMS\Redirect;

use Illuminate\Validation\Rule;

class RedirectUpdateRequest extends RedirectStoreRequest
{
    public function rules() : array
    {
        $rules = parent::rules();

        $rules['url_from'] = [
            'required',
            'string',
            'starts_with:/',
            Rule::unique('cms_redirects')->ignore($this->cms_redirect->id)
        ];

        return $rules;
    }
}
