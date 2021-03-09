<?php

namespace App\Actions\CMS\Page;

use App\Models\CMS\Page;
use App\Traits\CMS\ManagesContent;
use App\Traits\CMS\ManagesMetadata;
use App\Traits\CMS\ManagesPageUrl;
use Exception;
use Illuminate\Support\Facades\DB;

class PageUpdateAction
{
    use ManagesContent, ManagesMetadata, ManagesPageUrl;

    public function handle(Page $page, array $page_data) : Page
    {
        $this->data = $page_data;

        // Extract the content data
        $content    = $this->extractContentFromData();
        $metadata   = $this->extractMetadataFromData();
        $url        = $this->extractUrlFromData();

        try {
            DB::beginTransaction();

            $page->update($this->data);
            $page->load('template');
            $page->load('template.templateFields');
            $page->load('metadata');
            $page->load('parent');
            $page->load('parent.url');

            $this->updateContent($page, $content);
            $this->updateMetadata($page, $metadata);
            $this->updatePageUrl($page, $url);

            DB::commit();

            return $page;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
