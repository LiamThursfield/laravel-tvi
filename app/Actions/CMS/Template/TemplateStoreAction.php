<?php

namespace App\Actions\CMS\Template;


use App\Models\CMS\Template;
use App\Models\CMS\TemplateField;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TemplateStoreAction
{
    /**
     * @param array $template_data
     * @return Template
     * @throws Exception
     */
    public function handle(array $template_data) : Template
    {
        // Extract the template fields data if it exists
        $template_fields_data = Arr::get($template_data, 'template_fields', []);
        unset($template_data['template_fields']);

        try {
            DB::beginTransaction();

            $template = Template::create($template_data);

            foreach ($template_fields_data as $data) {
                $data['template_id'] = $template->id;
                TemplateField::create($data);
            }

            DB::commit();

            return $template;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
