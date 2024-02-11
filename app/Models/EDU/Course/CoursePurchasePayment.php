<?php

namespace App\Models\EDU\Course;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $course_purchase_id
 * @property CoursePurchase $purchase
 * @property string $status
 * @property string $type
 * @property string $price
 * @property string $currency
 * @property Carbon $due_date
 * @property Carbon $paid_at
 * @property string $payment_gateway_response_id
 * @property array $payment_gateway_response
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_payable
 * @property string $checkout_url
 */
class CoursePurchasePayment extends Model
{
    use HasFactory;

    protected $table = 'edu_course_purchase_payments';

    protected $guarded = [];

    protected $casts = [
        'due_date'                  => 'date',
        'paid_at'                   => 'datetime',
        'payment_gateway_response'  => 'json'
    ];

    public function getIsPayableAttribute(): bool
    {
        if ($this->due_date > now()->format('Y-m-d')) {
            return false;
        }

        if (!is_null($this->paid_at)) {
            return false;
        }

        if (in_array($this->status, [
            CoursePurchaseInterface::PAYMENT_NOT_DUE,
            CoursePurchaseInterface::PAYMENT_STATUS_PAID,
            CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED,
        ])) {
            return false;
        }

        return true;
    }

    public function getCheckoutUrlAttribute(): string
    {
        return route(
            'website.edu.courses.purchases.payments.checkout',
            [
                'course' => $this->purchase->course->slug,
                'payment' => $this->id,
                'timestamp' => $this->created_at->timestamp,
            ]
        );
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(CoursePurchase::class, 'course_purchase_id');
    }
}
