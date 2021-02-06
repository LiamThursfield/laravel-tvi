<?php

namespace App\Actions\CMS\Layout;

use App\Models\CMS\Layout;
use App\Traits\CMS\ManagesContent;
use Exception;
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
        $this->data = $layout_data;

        // Extract the content
        $content = $this->extractContentFromData();

        try {
            DB::beginTransaction();

            $layout = Layout::create($this->data);

            $this->storeContent($layout, $content);

            DB::commit();

            return $layout;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
