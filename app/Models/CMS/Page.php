<?php

namespace App\Models\CMS;

use App\Traits\CMS\HasContent;
use App\Traits\CMS\HasMetadata;
use App\Traits\CMS\HasUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasContent, HasFactory, HasMetadata, HasUrl;

    protected $table = 'cms_pages';

    protected $guarded = [];

    public function layout() : BelongsTo
    {
        return $this->belongsTo(Layout::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function template() : BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
