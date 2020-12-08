<?php

namespace App\Http\Requests\Admin\CMS\Layout;

use App\Http\Requests\BaseIndexRequest;

class LayoutIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'layout_name' => 'nullable|string',
            'layout_slug' => 'nullable|string',
            'template_id' => 'nullable|string',
        ]);
    }
}
