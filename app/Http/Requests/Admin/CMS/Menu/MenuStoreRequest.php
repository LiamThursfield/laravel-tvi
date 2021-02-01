<?php

namespace App\Http\Requests\Admin\CMS\Menu;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CMS\CMSInterface;
use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Validation\Rule;

class MenuStoreRequest extends BaseRequest
{

    public function rules() : array
    {
        return [
            'menu_items.*.custom_class' => 'nullable|string',
            'menu_items.*.child_items'  => 'nullable|array', // TODO: Figure out how to recursively validate child items
            'menu_items.*.href'         => 'nullable|string',
            'menu_items.*.label'        => 'string',
            'menu_items.*.rel'          => 'nullable|string',
            'menu_items.*.target'       => 'nullable|string',
            'name' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'slug' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
                'unique:cms_menus'
            ],
        ];
    }
}
