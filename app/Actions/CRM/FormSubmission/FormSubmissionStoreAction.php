<?php

namespace App\Actions\CRM\FormSubmission;

use App\Interfaces\CRM\FormFieldInterface;
use App\Models\CRM\Contact;
use App\Models\CRM\Form;
use App\Models\CRM\FormSubmission;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FormSubmissionStoreAction
{
    protected Form $form;

    protected array $submissionData;


    /**
     * @param Form $form
     * @param array $submissionData
     * @return FormSubmission
     * @throws ValidationException | Exception
     */
    public function handle(Form $form, array $submissionData) : FormSubmission
    {
        $this->form = $form;
        $this->submissionData = app(ValidateFormSubmissionDataAction::class)->handle($form, $submissionData);

        if (!$form->relationLoaded('formFields')) {
            $form->load('formFields');
        }

        try {
            DB::beginTransaction();

            $contact = $this->createOrUpdateCrmContact();

            $formSubmission = FormSubmission::create([
                'contact_id'    => $contact ? $contact->id : null,
                'data'          => $this->submissionData,
                'form_id'       => $this->form->id,
            ]);

            DB::commit();

            return $formSubmission;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    protected function createOrUpdateCrmContact() : ?Contact
    {
        $data = $this->getCrmContactData();

        $emailSlug = Arr::get(FormFieldInterface::ALL_CRM_TYPES_MAPPED, FormFieldInterface::TYPE_CRM_EMAIL);
        $email = Arr::get($data, $emailSlug);
        unset($data[FormFieldInterface::TYPE_CRM_EMAIL]);

        if (!$email) {
            return null;
        }

        return Contact::updateOrCreate(
            ['email' => $email],
            $data
        );
    }

    protected function getCrmContactData() : array
    {
        $crmData = [];

        foreach ($this->form->formFields as $field) {
            // If the field is not a CRM field or is null, skip
            if (
                !in_array($field->type, FormFieldInterface::ALL_CRM_TYPES) ||
                is_null(Arr::get($this->submissionData, $field->slug))
            ) {
                continue;
            }

            $crmData[Arr::get(FormFieldInterface::ALL_CRM_TYPES_MAPPED, $field->type)]
                = Arr::get($this->submissionData, $field->slug);
        }

        // Get the marketing fields
        // We should only update marketing fields that are enabled in the form
        $marketingFields = [
            'marketing_email',
            'marketing_sms',
            'marketing_telephone',
        ];
        foreach ($marketingFields as $field) {
            if ($this->form[$field]) {
                $crmData[$field] = (bool) Arr::get($this->submissionData, $field, false);
            }
        }

        return $crmData;
    }
}