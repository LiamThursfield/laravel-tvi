<?php

namespace App\Actions\CMS\Page;

use App\Models\CMS\Content;
use App\Models\CMS\Page;
use App\Traits\CMS\ManagesContent;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PageUpdateAction
{
    use ManagesContent;

    public function handle(Page $page, array $page_data) : Page
    {
        $this->page_data = $page_data;

        // Extract the content data
        $content = $this->extractContentFromPageData();

        try {
            DB::beginTransaction();

            $page->update($this->page_data);

            $this->updateContent($page, $content);

            DB::commit();

            return $page;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function updateContent(Page $page, Collection $content)
    {
        // Get all the template fields for the new page
        $template_fields = $page->template->templateFields->keyBy('id');

        if (!count($template_fields)) {
            return;
        }

        // Advanced content validation
        $this->validateContent($content, $template_fields);

        $existing_content = $page->content->keyBy('template_field_id');
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
            $page->content()->saveMany($content_to_save);
            unset($content_to_save);
        }

        if (count($content_to_delete)) {
            Content::destroy($content_to_delete);
        }
    }
}
