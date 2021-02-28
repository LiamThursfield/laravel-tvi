<?php

namespace App\Actions\CRM\Form;

use App\Models\CRM\Form;
use App\Models\CRM\FormField;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FormStoreAction
{
    public function handle(array $form_data, bool $refresh = false) : Form
    {
        // Extract the template fields data if it exists
        $form_fields_data = Arr::get($form_data, 'form_fields', []);
        unset($form_data['form_fields']);

        try {
            DB::beginTransaction();

            $form = Form::create($form_data);

            foreach ($form_fields_data as $data) {
                $data['form_id'] = $form->id;
                FormField::create($data);
            }

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
}
