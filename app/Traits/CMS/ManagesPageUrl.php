<?php

namespace App\Traits\CMS;

use App\Models\CMS\Page;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

trait ManagesPageUrl
{
    use ManagesUrl;

    /**
     * @param Page $page
     * @param Collection $url_data
     * @throws ValidationException
     */
    protected function storePageUrl(Page $page, Collection $url_data)
    {
        $url_data = $this->formatUrlData(
            $url_data,
            $page->parent->url ?? null
        );

        $this->validateUniqueUrl($url_data);

        $page->url()->create($url_data->toArray());
    }

    protected function updatePageUrl(Page $page, Collection $url_data)
    {
        if (!$page->url) {
            $this->storePageUrl($page, $url_data);
            return;
        }

        $url_data = $this->formatUrlData(
            $url_data,
            $page->parent->url ?? null
        );

        $this->updateUrl($page->url, $url_data);
    }
}
