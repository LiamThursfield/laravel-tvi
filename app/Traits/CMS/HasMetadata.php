<?php

namespace App\Traits\CMS;

use App\Models\CMS\Metadata;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasMetadata
{
    public function metadata() : MorphOne
    {
        return $this->morphOne(Metadata::class, 'metadatable');
    }
}
