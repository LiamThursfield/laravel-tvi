<?php

namespace App\Models\CMS;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Url extends Model
{
    use HasFactory;

    protected $table = 'cms_urls';

    protected $guarded = [];

    protected $casts = [
        'expired_at'    => 'datetime',
        'published_at'  => 'datetime',
        'is_enabled'    => 'boolean',
    ];

    protected $appends = [
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

    public function urlable() : MorphTo
    {
        return $this->morphTo();
    }
}
