<?php

namespace App\Traits\CMS;

use App\Interfaces\CMS\TemplateFieldInterface;
use App\Models\CMS\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

trait ManagesContent
{
    use ManagesData;

    protected string $content_slug = 'content';

    protected function extractContentFromData() : Collection
    {
        $data = collect(Arr::get($this->data, $this->content_slug, []))->keyBy('template_field_id');
        unset($this->data[$this->content_slug]);

        return $data;
    }

    protected function storeContent(Model $model, Collection $content)
    {
        // Get all the template fields for the new model
        $template_fields = $model->template->templateFields->keyBy('id');

        if (!count($template_fields)) {
            return;
        }

        // Advanced content validation
        $this->validateContent($content, $template_fields);

        // Create the Content model if the template field exists
        $new_content = [];
        foreach ($content as $template_field_id => $c) {
            if (isset($template_fields[$template_field_id])) {
                $c['template_field_type'] = $template_fields[$template_field_id]->type;

                if (in_array($c['template_field_type'], TemplateFieldInterface::JSON_TYPES)) {
                    $c['data'] = json_encode(Arr::get($c, 'data'));
                }

                $new_content[] = new Content($c);
            }
        }

        $model->content()->saveMany($new_content);
    }

    protected function updateContent(Model $model, Collection $content)
    {
        // Get all the template fields for the model
        $template_fields = $model->template->templateFields->keyBy('id');

        if (!count($template_fields)) {
            $model->content()->delete();
            return;
        }

        // Advanced content validation
        $this->validateContent($content, $template_fields);

        $existing_content = $model->content->keyBy('template_field_id');
        $content_to_save = [];
        $content_to_delete = [];

        foreach ($template_fields as $template_field_id => $template_field) {
            // Format the data as JSON if necessary
            if (
                isset($content[$template_field_id]) &&
                in_array($template_fields[$template_field_id]->type, TemplateFieldInterface::JSON_TYPES)
            ) {
                $c = $content[$template_field_id];
                $c['data'] = json_encode(Arr::get($c, 'data'));
                $content->put($template_field_id, $c);
            }

            // Check if the field exists and is being updated
            if (isset($content[$template_field_id]) && isset($existing_content[$template_field_id])) {
                $existing_content[$template_field_id]['data'] = $content[$template_field_id]['data'];
                $existing_content[$template_field_id]['template_field_type'] = $template_fields[$template_field_id]->type;
                $content_to_save[$template_field_id] = $existing_content[$template_field_id];

                unset($content[$template_field_id]);
                unset($existing_content[$template_field_id]);
            }
            // Check if the field is new
            else if (isset($content[$template_field_id])) {
                $c = new Content($content[$template_field_id]);
                $c->template_field_type = $template_fields[$template_field_id]->type;
                $content_to_save[$template_field_id] = $c;
                unset($content[$template_field_id]);
            }
        }

        // Check if any of the existing content should be deleted
        foreach ($existing_content as $template_field_id => $ec) {
            if (!isset($template_fields[$template_field_id])) {
                $content_to_delete[] = $template_field_id ;
                unset($existing_content[$template_field_id]);
            }
        }

        if (count($content_to_save)) {
            $model->content()->saveMany($content_to_save);
            unset($content_to_save);
        }

        if (count($content_to_delete)) {
            Content::destroy($content_to_delete);
        }
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
