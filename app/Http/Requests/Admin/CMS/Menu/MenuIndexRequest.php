<?php

namespace App\Http\Requests\Admin\CMS\Menu;

use App\Http\Requests\BaseIndexRequest;

class MenuIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'menu_name' => 'nullable|string',
            'menu_slug' => 'nullable|string',
        ]);
    }
}
