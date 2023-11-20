<?php

namespace App\Models\EDU\Purchase;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Programme\Programme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $table = 'edu_purchase_items';

    protected $guarded = [];

    protected $casts = [];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'purchasable_id', 'id')
            ->where('purchasable_type', 'App\Models\EDU\Course\Course');
    }

    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }

    public function redeem(User $user): void
    {
        switch ($this->purchasable_type) {
            case Course::class:
                $user->purchasedCourses()->attach($this->purchasable_id);
                break;
            case Programme::class:
                $user->purchasedProgrammes()->attach($this->purchasable_id);
                break;
            default:
                throw new \Exception('Invalid purchasable type: ' . $this->purchasable_type);
        }
    }
}
