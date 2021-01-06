<?php

namespace App\Traits\CMS;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

trait ManagesContent
{
    protected string $content_slug = 'content';

    protected array $page_data = [];

    protected function extractContentFromPageData() : Collection
    {
        $data = collect(Arr::get($this->page_data, $this->content_slug, []))->keyBy('template_field_id');
        unset($this->page_data[$this->content_slug]);

        return $data;
    }

    protected function validateContent(Collection $content, Collection $template_fields)
    {
        $required_fields = $template_fields->where('is_required', true)->keyBy('id');

        if (!count($required_fields)) {
            return;
        }

        $missing_fields = [];
        foreach ($required_fields as $id => $field) {
            if (!isset($content[$id]) || !isset($content[$id]['data']) || !$content[$id]['data']) {
                $missing_fields[] = $field->name;
            }
        }

        if (count($missing_fields)) {
            throw ValidationException::withMessages([
                $this->content_slug => 'The following fields are required: ' . implode("', ", $missing_fields)
            ]);
        }
    }
}
