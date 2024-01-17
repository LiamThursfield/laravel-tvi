<?php

namespace App\Models\EDU\Course;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $course_id
 * @property Course $course
 * @property string $status
 * @property string $type
 * @property int $instalment_plan_id
 * @property CourseInstalmentPlan $instalmentPlan
 * @property string $email_address
 * @property int $user_id
 * @property User $user
 * @property Carbon $redeemed_at
 * @property bool $is_redeemed
 * @property string $total_price_due
 * @property string $currency
 * @property string $total_price_paid
 * @property string $total_price_outstanding
 * @property Carbon $full_price_paid_at
 * @property string $payment_gateway
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CoursePurchase extends Model
{
    use HasFactory;

    protected $table = 'edu_course_purchases';

    protected $guarded = [];

    protected $casts = [
        'full_price_paid_at'    => 'datetime',
        'is_refundable'         => 'bool',
        'redeemed_at'           => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function instalmentPlan(): HasOne
    {
        return $this->hasOne(CourseInstalmentPlan::class, 'id', 'instalment_plan_id')
            ->withTrashed();
    }

    public function purchasePayments(): HasMany
    {
        return $this->hasMany(CoursePurchasePayment::class, 'course_purchase_id');
    }

    public function getIsRedeemedAttribute(): bool
    {
        return ! is_null($this->redeemed_at);
    }

    public function getTotalPriceOutstandingAttribute(): string
    {
        return (int) $this->total_price_due - (int) $this->total_price_paid;
    }

    public function redeem(User $user): void
    {
        $user->courses()->attach($this->course_id);
    }
}
