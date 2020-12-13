<?php

namespace App\Models\CMS;

use App\Traits\CMS\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layout extends Model
{
    use HasContent, HasFactory;

    protected $table = 'cms_layouts';

    protected $guarded = [];

    public function template() : BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
