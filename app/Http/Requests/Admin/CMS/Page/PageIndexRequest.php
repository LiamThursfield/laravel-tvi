<?php

namespace App\Http\Requests\Admin\CMS\Page;

use App\Http\Requests\BaseIndexRequest;

class PageIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'layout_id'     => 'nullable|string',
            'page_is_live'  => 'nullable|string',
            'page_name'     => 'nullable|string',
            'page_slug'     => 'nullable|string',
            'parent_id'   => 'nullable|string',
            'template_id'   => 'nullable|string',
        ]);
    }
}
