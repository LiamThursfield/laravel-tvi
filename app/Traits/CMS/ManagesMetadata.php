<?php

namespace App\Traits\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait ManagesMetadata
{
    use ManagesData;

    protected string $metadata_slug = 'metadata';

    protected function extractMetadataFromData() : array
    {
        $data =Arr::get($this->data, $this->metadata_slug, []);
        unset($this->data[$this->metadata_slug]);

        return $data;
    }

    protected function storeMetadata(Model $model, array $metadata)
    {
        $model->metadata()->create($metadata);
    }

    protected function updateMetadata(Model $model, array $metadata)
    {
        if (is_null($model->metadata)) {
            $this->storeMetadata($model, $metadata);
            return;
        }

        $model->metadata()->update($metadata);
    }

}
