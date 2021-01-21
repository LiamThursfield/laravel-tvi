<?php

namespace App\Traits\CMS;

use App\Models\CMS\Url;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

trait ManagesUrl
{
    use ManagesData;

    protected string $url_slug = 'url';

    protected function buildFullUrl(string $main_url, ?Url $parent_url = null) : string
    {
        if (!$parent_url) {
            return $main_url;
        }

        // Main url starts with a slash, so ensure the parent url does not end with a slash
        $url = rtrim($parent_url->url_full, '/');
        $url .= $main_url;

        // Remove any trailing url from the full url, if the url isn't '/'
        if ($url !== '/') {
            $url = rtrim($url, '/');
        }

        return $url;
    }

    protected function extractUrlFromData() : Collection
    {
        $data = collect(Arr::get($this->data, $this->url_slug, []));
        unset($this->data[$this->url_slug]);

        return $data;
    }

    protected function formatMainUrl(string $url) : String
    {
        $url = trim($url);

        // Remove any slashes, and ensure the url starts with a slash
        $url = '/' . str_replace('/', '', $url);

        return $url;
    }

    protected function formatUrlData(Collection $url_data, ?Url $parent_url = null) : Collection
    {
        $url_data->put(
            'url_main',
            $this->formatMainUrl($url_data->get('url_main'))
        );

        $url_data->put(
            'url_full',
            $this->buildFullUrl($url_data->get('url_main'), $parent_url)
        );

        return $url_data;
    }

    /**
     * @param Url $url
     * @param Collection $url_data
     * @throws ValidationException
     */
    protected function updateUrl(Url $url, Collection $url_data)
    {
        $old_url_full = $url->url_full;
        $new_url_full = $url_data->get('url_full');

        $this->validateUniqueUrl($url_data, $url);

        $url->update($url_data->toArray());
        $this->updateChildUrls($url, $old_url_full, $new_url_full);
    }

    protected function updateChildUrls(Url $url, string $old_url_full, string $new_url_full)
    {
        if ($old_url_full === $new_url_full) {
            return;
        }

        // Add trailing slash to avoid updating similar urls
        $old_url_full .= '/';
        $new_url_full .= '/';

        $old_url_full_length = strlen($old_url_full);

        // Get the urls that need updating
        $query = Url::query()->where('url_full', 'like', $old_url_full . '%')
            ->where('id', '<>', $url->id)
            ->select('id', 'url_full');


        // The below code was adapted from an online guide on how to efficiently update multiple records
        // https://medium.com/@sentiasa/bulk-update-multiple-records-with-separate-data-laravel-3da9131c279a
        $query->chunk(100, function ($urls) use ($old_url_full_length, $new_url_full) {
            $cases  = [];
            $ids    = [];
            $params = [];

            foreach ($urls as $url) {
                $cases[] = "WHEN id = {$url->id} then ?";
                $params[] = $new_url_full . substr($url->url_full, $old_url_full_length);
                $ids[] = $url->id;
            }

            if (count($ids)) {
                $query = "UPDATE `cms_urls` SET `url_full` = CASE ";
                $query .= implode(' ', $cases);
                $query .= " END WHERE id in (" . implode(',', $ids) . ")";

                DB::update($query, $params);
            }
        });
    }

    /**
     * @param Collection $url_data
     * @param Url|null $existing_url
     * @throws ValidationException
     */
    protected function validateUniqueUrl(Collection $url_data, ?Url $existing_url = null) {
        $query = Url::where('url_full', $url_data->get('url_full'));

        if (!is_null($existing_url)) {
            $query->where('id', '<>', $existing_url->id);
        }

        if ($query->count() < 1) {
            return;
        }

        throw ValidationException::withMessages([
            $this->url_slug . '.url_full' => 'The url must be unique.'
        ]);
    }
}
