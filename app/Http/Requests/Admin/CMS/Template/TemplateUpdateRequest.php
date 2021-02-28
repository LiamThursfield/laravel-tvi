<?php

namespace App\Http\Requests\Admin\CMS\Template;

use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Validation\Rule;

class TemplateUpdateRequest extends TemplateStoreRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['slug'] = [
            'required',
            'string',
            'max:' . TemplateInterface::FIELD_SLUG_MAX_LENGTH,
            // Slug should be unique per template type
            Rule::unique('cms_templates')->where(function ($query) {
                $ignored_types = TemplateInterface::ALL_TYPES_LABELLED;
                unset($ignored_types[$this->request->get('type')]);
                $ignored_types = array_keys($ignored_types);

                return $query->whereNotIn('type', $ignored_types);
            })->ignore($this->template->id, 'id')
        ];

        return $rules;
    }
}
