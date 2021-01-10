<?php

namespace App\Traits\CMS;

use App\Models\CMS\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContent
{

    public function content() : MorphMany
    {
        return $this->morphMany(Content::class, 'contentable');
    }

}
