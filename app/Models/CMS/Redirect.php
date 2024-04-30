<?php

namespace App\Models\CMS;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $url_from
 * @property string $url_to
 * @property bool $is_active
 * @property bool $is_enabled
 * @property bool $is_permanent
 * @property int $http_status
 * @property ?Carbon $published_at
 * @property ?Carbon $expired_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Builder active()
 * @method static Redirect create(array $data)
 */
class Redirect extends Model
{
    use HasFactory;

    protected $table = 'cms_redirects';

    protected $guarded = [];

    protected $casts = [
        'expired_at'    => 'datetime',
        'is_enabled'    => 'boolean',
        'is_permanent'  => 'boolean',
        'published_at'  => 'datetime'
    ];

    public function getHttpStatusAttribute(): int
    {
        return $this->is_permanent ? 301 : 302;
    }

    public function getIsActiveAttribute(): bool
    {
        // Not enabled
        if (!$this->is_enabled) {
            return false;
        }

        // Not yet reached published date
        if (!is_null($this->published_at) && $this->published_at->isAfter(now())) {
            return false;
        }

        // Expiration date has been reached
        if (!is_null($this->expired_at) && $this->expired_at->isBefore(now())) {
            return false;
        }

        return true;
    }

    protected function scopeActive(Builder $query): Builder
    {
        return $query->where('is_enabled', true)
            ->where(function (Builder $subQ) {
                $subQ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })->where(function (Builder $subQ) {
                $subQ->whereNull('expired_at')
                    ->orWhere('expired_at', '>=', now());
            });
    }
}
