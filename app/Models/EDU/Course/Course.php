<?php

namespace App\Models\EDU\Course;

use App\Interfaces\EDU\Purchase\PurchaseInterface;
use App\Models\EDU\Label\Label;
use App\Models\EDU\Programme\Programme;
use App\Models\EDU\Purchase\PurchaseItem;
use App\Models\EDU\Section\Section;
use App\Models\EDU\Webinar\Webinar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_courses';

    protected $guarded = [];

    protected $casts = [];

    public function getTotalQuantitySoldAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_PAID);
            })
            ->count();
    }

    public function getTotalQuantityRefundedAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_REFUNDED);
            })
            ->count();
    }

    public function getTotalQuantityPendingAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_PENDING);
            })
            ->count();
    }

    public function getTotalProfitAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_PAID);
            })
            ->sum('total_price');
    }

    public function getTotalRefundedAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_REFUNDED);
            })
            ->sum('total_price');
    }

    public function getTotalProfitPendingAttribute()
    {
        return $this->purchases()
            ->whereHas('purchase', function ($query) {
                return $query->where('payment_status', '=', PurchaseInterface::PAYMENT_STATUS_PENDING);
            })
            ->sum('total_price');
    }

    public function purchases(): BelongsTo
    {
        return $this->belongsTo(PurchaseItem::class,'id', 'purchasable_id')
            ->where('purchasable_type', 'App\Models\EDU\Course\Course')
            ->with('purchase');
    }

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'edu_course_labels', 'course_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)
            ->with('childItems')
            ->orderBy('index');
    }

    public function webinars(): HasMany
    {
        return $this->hasMany(Webinar::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'edu_programme_users', 'course_id');
    }
}
