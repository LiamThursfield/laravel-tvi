<?php

namespace App\Actions\CMS\Page;

use App\Models\CMS\Content;
use App\Models\CMS\Page;
use App\Traits\CMS\ManagesContent;
use App\Traits\CMS\ManagesPageUrl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PageStoreAction
{
    use ManagesContent, ManagesPageUrl;

    public function handle(array $page_data) : Page
    {
        $this->data = $page_data;

        // Extract the relation data
        $content = $this->extractContentFromData();
        $url     = $this->extractUrlFromData();

        try {
            DB::beginTransaction();

            $page = Page::create($this->data);
            $page->load('parent');
            $page->load('parent.url');

            $this->storePageUrl($page, $url);
            $this->storeContent($page, $content);

            DB::commit();

            return $page;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function storeContent(Page $page, Collection $content)
    {
        // Get all the template fields for the new page
        $template_fields = $page->template->templateFields->keyBy('id');

        if (!count($template_fields)) {
            return;
        }

        // Advanced content validation
        $this->validateContent($content, $template_fields);

        // Create the Content model if the template field exists
        $new_content = [];
        foreach ($content as $template_field_id => $c) {
            if (isset($template_fields[$template_field_id])) {
                $c['template_field_type'] = $template_fields[$template_field_id]->type;
                $new_content[] = new Content($c);
            }
        }

        $page->content()->saveMany($new_content);
    }
}
