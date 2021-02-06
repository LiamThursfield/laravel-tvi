<?php

namespace App\Actions\CMS\Layout;

use App\Models\CMS\Layout;
use App\Traits\CMS\ManagesContent;
use Exception;
use Illuminate\Support\Facades\DB;

class LayoutUpdateAction
{
    use ManagesContent;

    /**
     * @param Layout $layout
     * @param array $layout_data
     * @return Layout
     * @throws Exception
     */
    public function handle(Layout $layout, array $layout_data) : Layout
    {
        $this->data = $layout_data;

        // Extract the content
        $content = $this->extractContentFromData();

        try {
            DB::beginTransaction();

            $layout->update($this->data);

            $this->updateContent($layout, $content);

            DB::commit();

            return $layout;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
