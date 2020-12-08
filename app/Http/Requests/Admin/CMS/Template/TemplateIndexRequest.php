<?php

namespace App\Http\Requests\Admin\CMS\Template;

use App\Http\Requests\BaseIndexRequest;

class TemplateIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'template_name'     => 'nullable|string',
            'template_slug'     => 'nullable|string',
            'template_type'     => 'nullable|string',
        ]);
    }
}
