<?php

namespace App\Models\EDU\Course;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $course_id
 * @property Course $course
 * @property int $instalment_count
 * @property string $instalment_price
 * @property null|string $instalment_discount_price
 * @property null|string $instalment_current_price
 * @property string $currency
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class CourseInstalmentPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_course_instalment_plans';

    protected $guarded = [];

    protected $casts = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getInstalmentCurrentPriceAttribute(): string
    {
        return $this->instalment_discount_price ? $this->instalment_discount_price : $this->instalment_price;
    }
}
