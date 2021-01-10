<?php

namespace App\Actions\CMS\Layout;

use App\Models\CMS\Content;
use App\Models\CMS\Layout;
use App\Traits\CMS\ManagesContent;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LayoutStoreAction
{
    use ManagesContent;

    /**
     * @param array $layout_data
     * @return Layout
     * @throws Exception
     */
    public function handle(array $layout_data) : Layout
    {
        // Extract the content
        $content = collect(Arr::get($layout_data, $this->content_slug, []))->keyBy('template_field_id');
        unset($layout_data[$this->content_slug]);

        try {
            DB::beginTransaction();

            $layout = Layout::create($layout_data);

            $this->storeContent($layout, $content);

            DB::commit();

            return $layout;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function storeContent(Layout $layout, Collection $content)
    {
        // Get all the template fields for the new layout
        $template_fields = $layout->template->templateFields->keyBy('id');

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

        $layout->content()->saveMany($new_content);
    }
}
