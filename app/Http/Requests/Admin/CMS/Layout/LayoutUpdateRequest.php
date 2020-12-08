<?php

namespace App\Http\Requests\Admin\CMS\Layout;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CMS\CMSInterface;
use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Validation\Rule;

class LayoutUpdateRequest extends BaseRequest
{
    public function attributes() : array
    {
        $custom_attributes = [
            'template_id' => 'template'
        ];

        return array_merge(parent::attributes(), $custom_attributes);
    }

    public function rules() : array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'template_id' => [
                'required',
                'integer',
                Rule::exists('cms_templates', 'id')->where(function ($query) {
                    $query->where('type', TemplateInterface::TYPE_LAYOUT);
                }),
            ],
            'slug' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
                Rule::unique('cms_layouts')->ignore($this->layout->id, 'id')
            ],
        ];
    }
}
