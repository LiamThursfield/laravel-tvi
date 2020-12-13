<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
    use HasFactory;

    protected $table = 'cms_content';

    protected $guarded = [];

    public function contentable() : MorphTo
    {
        return $this->morphTo();
    }

    public function templateField() : BelongsTo
    {
        return $this->belongsTo(TemplateField::class);
    }
}
