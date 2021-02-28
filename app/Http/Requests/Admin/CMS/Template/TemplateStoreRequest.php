<?php

namespace App\Http\Requests\Admin\CMS\Template;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Validation\Rule;

class TemplateStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'description' => 'nullable|string',
            'name' => [
                'required',
                'string',
                'max:' . TemplateInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'slug' => [
                'required',
                'string',
                'max:' . TemplateInterface::FIELD_SLUG_MAX_LENGTH,
                // Slug should be unique per template type
                Rule::unique('cms_templates')->where(function ($query) {
                    $ignored_types = TemplateInterface::ALL_TYPES_LABELLED;
                    unset($ignored_types[$this->request->get('type')]);
                    $ignored_types = array_keys($ignored_types);

                    return $query->whereNotIn('type', $ignored_types);
                })
            ],
            'type' => [
                'required',
                Rule::in(TemplateInterface::ALL_TYPES),
            ],

            // Template Fields
            'template_fields.*.description' => 'nullable|string',
            'template_fields.*.id' => 'nullable|integer',
            'template_fields.*.is_required' => 'sometimes|boolean',
            'template_fields.*.name' => [
                'required',
                'string',
                'max:' . TemplateFieldInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'template_fields.*.order' => 'required|integer',
            'template_fields.*.settings' => 'sometimes|array',
            'template_fields.*.slug' => [
                'required',
                'string',
                'max:' . TemplateFieldInterface::FIELD_SLUG_MAX_LENGTH,
            ],
            'template_fields.*.type' => [
                'required',
                Rule::in(TemplateFieldInterface::ALL_TYPES),
            ],
        ];
    }
}
