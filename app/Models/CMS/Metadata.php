<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Metadata extends Model
{
    use HasFactory;

    protected $table = 'cms_metadata';

    protected $guarded = [];

    public function metadatable() : MorphTo
    {
        return $this->morphTo();
    }
}
