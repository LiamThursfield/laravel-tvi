<?php

namespace App\Actions\CRM\FormSubmission;

use App\Interfaces\CRM\FormFieldInterface;
use App\Models\CRM\Form;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidateFormSubmissionDataAction
{
    /**
     * @param Form $form
     * @param array $submissionData
     * @return array
     * @throws ValidationException
     */
    public function handle(Form $form, array $submissionData) : array
    {
        if (!$form->relationLoaded('formFields')) {
            $form->load('formFields');
        }

        $rules = [];
        $messages = [];

        // Add validation rules for the form fields
        foreach ($form->formFields as $field) {
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
                $messages[$field->slug . '.required'] = 'The ' . $field->name . ' field is required.';
            } else {
                $fieldRules[] = 'nullable';
            }

            if (in_array($field->type, [FormFieldInterface::TYPE_EMAIL, FormFieldInterface::TYPE_CRM_EMAIL])) {
                $fieldRules[] = 'email';
                $messages[$field->slug . '.email'] = 'The ' . $field->name . ' field must be a valid email address.';
            } elseif ($field->type === FormFieldInterface::TYPE_NUMBER) {
                $fieldRules[] = 'numeric';
                $messages[$field->slug . '.numeric'] = 'The ' . $field->name . ' field must be a number.';
            }

            $rules[$field->slug] = implode('|', $fieldRules);
        }

        // Add validation rules for the marketing fields
        $marketingFields = [
            'marketing_email'       => 'Email',
            'marketing_sms'         => 'Email',
            'marketing_telephone'   => 'Email',
        ];
        foreach ($marketingFields as $fieldSlug => $fieldLabel) {
            if ($form[$fieldSlug]) {
                $rules[$fieldSlug] = 'nullable|boolean';
                $messages[$fieldSlug . '.boolean'] = 'The ' . $fieldLabel . ' marketing field must be true/false.';
            }
        }

        $validator = Validator::make($submissionData, $rules, $messages);
        return $validator->validate();
    }

}