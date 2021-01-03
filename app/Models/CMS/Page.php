<?php

namespace App\Models\CMS;

use App\Traits\CMS\HasContent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasContent, HasFactory;

    protected $table = 'cms_pages';

    protected $guarded = [];

    protected $casts = [
        'enabled_at'    => 'datetime',
        'expired_at'    => 'datetime',
        'published_at'  => 'datetime',
    ];

    protected $appends = [
        'is_enabled',
        'is_expired',
        'is_live',
        'is_published',
    ];


    /***********************
     * Attribute Modifiers *
     **********************/

    public function setEnabledAtAttribute($value)
    {
        if (is_bool($value)) {
            $this->attributes['enabled_at'] = Carbon::now();
            return;
        }

        $this->attributes['enabled_at'] = $value;
    }


    /*********************
     * Custom Attributes *
     *********************/

    public function getIsEnabledAttribute() : bool
    {
        return !is_null($this->enabled_at) && Carbon::now()->gte($this->enabled_at);
    }

    public function getIsExpiredAttribute() : bool
    {
        return !is_null($this->expired_at) && Carbon::now()->gte($this->expired_at);
    }

    public function getIsLiveAttribute() : bool
    {
        return $this->is_enabled && $this->is_published && !$this->is_expired;
    }

    public function getIsPublishedAttribute() : bool
    {
        return is_null($this->published_at) || Carbon::now()->gte($this->published_at);
    }


    /*****************
     * Relationships *
     *****************/

    public function layout() : BelongsTo
    {
        return $this->belongsTo(Layout::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function template() : BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
