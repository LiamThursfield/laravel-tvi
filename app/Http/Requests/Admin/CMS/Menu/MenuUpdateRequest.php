<?php

namespace App\Http\Requests\Admin\CMS\Menu;

use App\Interfaces\CMS\CMSInterface;
use Illuminate\Validation\Rule;

class MenuUpdateRequest extends MenuStoreRequest
{

    public function rules() : array
    {
        $rules = parent::rules();

        $rules['slug'] = [
            'required',
            'string',
            'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
            Rule::unique('cms_menus')->ignore($this->menu->id, 'id')
        ];

        return $rules;
    }
}
