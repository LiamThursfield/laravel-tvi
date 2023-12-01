<?php

namespace App\Models\EDU\Course;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $course_purchase_id
 * @property CoursePurchase $purchase
 * @property string $status
 * @property string $type
 * @property string $price
 * @property Carbon $due_date
 * @property Carbon $paid_at
 * @property string $payment_gateway_response_id
 * @property array $payment_gateway_response
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CoursePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_course_instalment_plans';

    protected $guarded = [];

    protected $casts = [
        'due_date'                  => 'datetime',
        'paid_at'                   => 'datetime',
        'payment_gateway_response'  => 'json'
    ];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(CoursePurchase::class);
    }
}
