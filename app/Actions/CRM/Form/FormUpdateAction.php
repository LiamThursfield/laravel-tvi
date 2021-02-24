<?php

namespace App\Actions\CRM\Form;

use App\Models\CRM\Form;
use App\Models\CRM\FormField;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FormUpdateAction
{
    /**
     * @param Form $form
     * @param array $form_data
     * @param bool $refresh
     * @return Form
     * @throws Exception
     */
    public function handle(Form $form, array $form_data, bool $refresh = false) : Form
    {
        // Extract the template fields data if it exists
        $form_fields_data = Arr::get($form_data, 'form_fields', null);
        unset($form_data['form_fields']);

        try {
            DB::beginTransaction();

            $form->update($form_data);

            $form =$this->updateFields($form, $form_fields_data);

            DB::commit();

            if ($refresh) {
                $form->refresh();
            }

            return $form;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    /**
     * @param Form $form
     * @param array|null $form_fields_data
     * @return Form
     * @throws Exception
     */
    protected function updateFields(Form $form, ?array $form_fields_data) : Form
    {
        // If the data is null, don't bother updating or deleting any fields
        if (is_null($form_fields_data)) {
            return $form;
        }

        // If there are no fields in the data, delete any existing fields
        if (count($form_fields_data) === 0) {
            $form->templateFields()->delete();
            return $form;
        }

        $form->load('formFields');
        $existing_fields = [];
        foreach ($form->formFields as $field) {
            $existing_fields[$field->id] = $field;
        }

        foreach ($form_fields_data as $data) {
            // If the data has an id, it's an existing field that needs updating
            $field_id = Arr::get($data, 'id');
            if (!is_null($field_id)) {
                if (!isset($existing_fields[$field_id])) {
                    throw new Exception(
                        "Attempting to update non-existent field with id ${field_id} of form " . $form->id
                    );
                }

                $existing_fields[$field_id]->update($data);
                unset($existing_fields[$field_id]);
            }
            // Otherwise, it is a new field
            else {
                $data['form_id'] = $form->id;
                FormField::create($data);
            }
        }

        // If there are any remaining existing fields, they need deleting
        if (count($existing_fields)) {
            FormField::destroy(array_keys($existing_fields));
        }

        return $form;
    }
}
