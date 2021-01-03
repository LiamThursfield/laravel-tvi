<?php

namespace App\Actions\CMS\Page;

use App\Actions\CMS\AbstractContentCrudAction;
use App\Models\CMS\Content;
use App\Models\CMS\Page;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PageStoreAction extends AbstractContentCrudAction
{

    public function handle(array $page_data) : Page
    {
        // Extract the content
        $content = collect(Arr::get($page_data, $this->content_slug, []))->keyBy('template_field_id');
        unset($page_data[$this->content_slug]);

        try {
            DB::beginTransaction();

            $page = Page::create($page_data);

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
                $new_content[] = new Content($c);
            }
        }

        $page->content()->saveMany($new_content);
    }
}
