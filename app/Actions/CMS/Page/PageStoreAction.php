<?php

namespace App\Actions\CMS\Page;

use App\Models\CMS\Page;
use App\Traits\CMS\ManagesContent;
use App\Traits\CMS\ManagesMetadata;
use App\Traits\CMS\ManagesPageUrl;
use Exception;
use Illuminate\Support\Facades\DB;

class PageStoreAction
{
    use ManagesContent, ManagesMetadata, ManagesPageUrl;

    public function handle(array $page_data) : Page
    {
        $this->data = $page_data;

        // Extract the relation data
        $content    = $this->extractContentFromData();
        $metadata   = $this->extractMetadataFromData();
        $url        = $this->extractUrlFromData();

        try {
            DB::beginTransaction();

            $page = Page::create($this->data);
            $page->load('parent');
            $page->load('parent.url');

            $this->storeContent($page, $content);
            $this->storeMetadata($page,$metadata);
            $this->storePageUrl($page, $url);

            DB::commit();

            return $page;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
