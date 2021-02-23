<?php

namespace App\Actions\CMS\Template;


use App\Models\CMS\Template;
use App\Models\CMS\TemplateField;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TemplateUpdateAction
{
    /**
     * @param Template $template
     * @param array $template_data
     * @return Template
     * @throws Exception
     */
    public function handle(Template $template, array $template_data) : Template
    {
        // Extract the template fields data if it exists
        $template_fields_data = Arr::get($template_data, 'template_fields', null);
        unset($template_data['template_fields']);

        try {
            DB::beginTransaction();

            $template->update($template_data);

            $template = $this->updateFields($template, $template_fields_data);

            DB::commit();

            return $template;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param Template $template
     * @param array|null $template_fields_data
     * @return Template
     * @throws Exception
     */
    protected function updateFields(Template $template, ?array $template_fields_data) : Template
    {
        // If the data is null, don't bother updating or deleting any fields
        if (is_null($template_fields_data)) {
            return $template;
        }

        // If there are no fields in the data, delete any existing fields
        if (count($template_fields_data) === 0) {
            $template->templateFields()->delete();
            return $template;
        }

        $template->load('templateFields');
        $existing_template_fields = [];
        foreach ($template->templateFields as $field) {
            $existing_template_fields[$field->id] = $field;
        }

        foreach ($template_fields_data as $data) {
            // If the data has an id, it's an existing field that needs updating
            $field_id = Arr::get($data, 'id');
            if (!is_null($field_id)) {
                if (!isset($existing_template_fields[$field_id])) {
                    throw new Exception(
                        "Attempting to update non-existent field with id ${field_id} of template " . $template->id
                    );
                }

                $existing_template_fields[$field_id]->update($data);
                unset($existing_template_fields[$field_id]);
            }
            // Otherwise, it is a new field
            else {
                $data['template_id'] = $template->id;
                TemplateField::create($data);
            }
        }

        // If there are any existing fields, they need deleting
        if (count($existing_template_fields)) {
            TemplateField::destroy(array_keys($existing_template_fields));
        }

        return $template;
    }
}
