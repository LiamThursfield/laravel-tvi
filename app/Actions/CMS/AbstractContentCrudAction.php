<?php

namespace App\Actions\CMS;

use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

abstract class AbstractContentCrudAction
{
    protected string $content_slug = 'content';

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
