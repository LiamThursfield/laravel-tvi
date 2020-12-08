<?php

namespace App\Actions\CMS\Layout;

use App\Models\CMS\Layout;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LayoutStoreAction
{
    /**
     * @param array $layout_data
     * @return Layout
     * @throws Exception
     */
    public function handle(array $layout_data) : Layout
    {
        // Extract the content
        $template_field_content = Arr::get($layout_data, 'template_field_content', []);
        unset($layout_data['template_field_content']);

        try {
            DB::beginTransaction();

            $layout = Layout::create($layout_data);

            // TODO: Template Field Content

            DB::commit();

            return $layout;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
