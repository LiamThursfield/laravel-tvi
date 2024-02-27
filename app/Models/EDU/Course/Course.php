<?php

namespace App\Models\EDU\Course;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Interfaces\EDU\Webinar\WebinarInterface;
use App\Models\EDU\Label\Label;
use App\Models\EDU\Programme\Programme;
use App\Models\EDU\Section\Section;
use App\Models\EDU\Webinar\Webinar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property Carbon $available_from
 * @property Carbon $available_to
 * @property string $banner
 * @property string $content_length_video
 * @property User $creator
 * @property int $creator_id
 * @property string $currency
 * @property string $current_price
 * @property string $description
 * @property string $discount_price
 * @property string $vat
 * @property string $price_vat
 * @property bool $has_certificate
 * @property bool $has_captions
 * @property bool $has_free_seo_exposure
 * @property bool $has_lifetime_access
 * @property bool $has_money_back_guarantee
 * @property bool $has_pdfs
 * @property bool $has_student_discount
 * @property bool $has_webinars
 * @property int $id
 * @property bool $is_purchasable
 * @property Collection<Label> $labels
 * @property string $languages
 * @property string $name
 * @property Programme $programme
 * @property Collection<Section> $sections
 * @property string $slug
 * @property string $status
 * @property string $summary
 * @property Collection<User> $participants
 * @property string $price
 * @property string $primary_image
 * @property Collection<Webinar> $webinars
 * @property string $video_preview
 *
 * @property carbon $created_at
 * @property carbon $updated_at
 * @property carbon $deleted_at
 */
class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_courses';

    protected $guarded = [];

    protected $casts = [
        'available_from' => 'datetime',
        'available_to' => 'datetime',
        'has_certificate' => 'boolean',
        'has_captions' => 'boolean',
        'has_lifetime_access' => 'boolean',
        'has_free_seo_exposure' => 'boolean',
        'has_money_back_guarantee' => 'boolean',
        'has_pdfs' => 'boolean',
        'has_student_discount' => 'boolean',
        'has_webinars' => 'boolean',
    ];

    public function getTotalQuantitySoldAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_PAID)
            ->count();
    }

    public function getTotalQuantityRefundedAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED)
            ->count();
    }

    public function getTotalQuantityPendingAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_PENDING)
            ->count();
    }

    public function getTotalProfitAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_PAID)
            ->sum('total_price_due');
    }

    public function getTotalRefundedAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED)
            ->sum('total_price_due');
    }

    public function getTotalProfitPendingAttribute()
    {
        return $this->purchases()
            ->whereStatus(CoursePurchaseInterface::PAYMENT_STATUS_PENDING)
            ->sum('total_price_due');
    }

    public function purchases(): BelongsTo
    {
        return $this->belongsTo(CoursePurchase::class,'id', 'course_id');
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
            ->orderBy('index', 'asc');
    }

    public function webinars(): HasMany
    {
        return $this->hasMany(Webinar::class)->where('status', WebinarInterface::STATUS_PUBLISHED);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'edu_programme_users', 'course_id');
    }

    public function instalmentPlans(): HasMany
    {
        return $this->hasMany(CourseInstalmentPlan::class, 'course_id');
    }

    public function scopeIsPurchasable(Builder $query): void
    {
        $query->where('status', CourseInterface::STATUS_PUBLISHED);

        $query->where(function(Builder $q) {
            $q->whereNull('available_from')
                ->orWhereDate('available_from', '<=', now());
        });

        $query->where(function(Builder $q) {
            $q->whereNull('available_to')
                ->orWhereDate('available_to', '>=', now());
        });
    }

    public function getIsPurchasableAttribute(): bool
    {
        // Not published
        if ($this->status !== CourseInterface::STATUS_PUBLISHED) {
            return false;
        }

        // Not yet available
        if (!is_null($this->available_from) && $this->available_from > now()) {
            return false;
        }

        // Is no longer available
        if (!is_null($this->available_to) && $this->available_to < now()) {
            return false;
        }

        return true;
    }

    public function getCurrentPriceAttribute(): string
    {
        return ($this->discount_price ?: $this->price) * 100;
    }
}
