<?php

namespace App\Traits\CMS;

use App\Models\CMS\Content;
use App\Models\CMS\TemplateField;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContent
{

    public function content() : MorphMany
    {
        return $this->morphMany(Content::class, 'contentable');
    }

}
