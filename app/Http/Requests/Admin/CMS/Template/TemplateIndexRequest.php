<?php

namespace App\Http\Requests\Admin\CMS\Template;

use Illuminate\Foundation\Http\FormRequest;

class TemplateIndexRequest extends FormRequest
{
    public int $status = 303;

    /**
     * Define the rules for the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_by'          => 'nullable|string',
            'order_direction'   => 'nullable|string',
            'per_page'          => 'nullable|integer',
            'template_name'     => 'nullable|string',
            'template_slug'     => 'nullable|string',
            'template_type'     => 'nullable|string',
        ];
    }
}
