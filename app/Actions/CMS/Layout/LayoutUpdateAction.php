<?php

namespace App\Actions\CMS\Layout;

use App\Actions\CMS\AbstractContentCrudAction;
use App\Models\CMS\Content;
use App\Models\CMS\Layout;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LayoutUpdateAction extends AbstractContentCrudAction
{
    /**
     * @param Layout $layout
     * @param array $layout_data
     * @return Layout
     * @throws Exception
     */
    public function handle(Layout $layout, array $layout_data) : Layout
    {
        // Extract the content
        $content = collect(Arr::get($layout_data, $this->content_slug, []))->keyBy('template_field_id');
        unset($layout_data[$this->content_slug]);

        try {
            DB::beginTransaction();

            $layout->update($layout_data);

            $this->updateContent($layout, $content);

            DB::commit();

            return $layout;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function updateContent(Layout $layout, Collection $content)
    {
        // Get all the template fields for the new layout
        $template_fields = $layout->template->templateFields->keyBy('id');

        if (!count($template_fields)) {
            $layout->content()->delete();
            return;
        }

        // Advanced content validation
        $this->validateContent($content, $template_fields);

        $existing_content = $layout->content->keyBy('template_field_id');
        $content_to_save = [];
        $content_to_delete = [];

        foreach ($template_fields as $template_field_id => $template_field) {
            // Check if the field exists and is being updated
            if (isset($content[$template_field_id]) && isset($existing_content[$template_field_id])) {
                $existing_content[$template_field_id]['data'] = $content[$template_field_id]['data'];
                $content_to_save[$template_field_id] = $existing_content[$template_field_id];

                unset($content[$template_field_id]);
                unset($existing_content[$template_field_id]);
            }
            // Check if the field is new
            else if (isset($content[$template_field_id])) {
                $content_to_save[] = new Content($content[$template_field_id]);
                unset($content[$template_field_id]);
            }
        }

        // Check if any of the existing content should be deleted
        foreach ($existing_content as $template_field_id => $ec) {
            if (!isset($template_fields[$template_field_id])) {
                $content_to_delete[] = $template_field_id ;
                unset($existing_content[$template_field_id]);
            }
        }

        if (count($content_to_save)) {
            $layout->content()->saveMany($content_to_save);
            unset($content_to_save);
        }

        if (count($content_to_delete)) {
            Content::destroy($content_to_delete);
        }

    }
}
