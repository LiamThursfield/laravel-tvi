<?php

namespace App\Http\Requests\Admin\CMS\Layout;

use App\Interfaces\CMS\CMSInterface;
use Illuminate\Validation\Rule;

class LayoutUpdateRequest extends LayoutStoreRequest
{
    public function attributes() : array
    {
        $custom_attributes = [
            'content.*.template_field_id' => 'template field',
            'template_id' => 'template'
        ];

        return array_merge(parent::attributes(), $custom_attributes);
    }

    public function rules() : array
    {
        $rules = parent::rules();

        $rules['slug'] = [
            'required',
            'string',
            'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
            Rule::unique('cms_layouts')->ignore($this->layout->id, 'id')
        ];

        return $rules;
    }
}
