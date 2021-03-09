<?php

namespace App\Http\Requests\Admin\CRM\Form;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CRM\FormFieldInterface;
use App\Interfaces\CRM\FormInterface;
use Illuminate\Validation\Rule;

class FormStoreRequest extends BaseRequest
{
    public function attributes() : array
    {
        $custom_attributes = [
            'email_recipients.*'   => 'email recipient',
        ];

        return array_merge(parent::attributes(), $custom_attributes);
    }

    public function rules() : array
    {
        return [
            'description'           => 'nullable|string',
            'email_recipients.*'    => 'required|email',
            'marketing_email'       => 'nullable|boolean',
            'marketing_sms'         => 'nullable|boolean',
            'marketing_telephone'   => 'nullable|boolean',
            'name' => [
                'required',
                'string',
                'max:' . FormInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'redirect_url' => [
                'nullable',
                'string',
                'max:' . FormInterface::FIELD_REDIRECT_URL_MAX_LENGTH,
            ],
            'slug' => [
                'required',
                'string',
                'max:' . FormInterface::FIELD_SLUG_MAX_LENGTH,
                Rule::unique('crm_forms'),
            ],
            'success_message' => [
                'nullable',
                'string',
                'max:' . FormInterface::FIELD_SUCCESS_MESSAGE_MAX_LENGTH,
            ],

            // Form Fields
            'form_fields.*.is_required' => 'sometimes|boolean',
            'form_fields.*.name' => [
                'required',
                'string',
                'max:' . FormFieldInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'form_fields.*.order' => 'required|integer',
            'form_fields.*.settings' => 'sometimes|array',
            'form_fields.*.slug' => [
                'required',
                'string',
                'max:' . FormFieldInterface::FIELD_SLUG_MAX_LENGTH,
            ],
            'form_fields.*.type' => [
                'required',
                Rule::in(FormFieldInterface::getAllTypes()),
            ],
        ];
    }
}
