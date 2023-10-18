<?php

namespace App\Models\EDU\Programme;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Label\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programme extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_programmes';

    protected $guarded = [];

    protected $casts = [];

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'edu_programme_labels', 'programme_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'edu_course_programmes', 'programme_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'edu_programme_users', 'programme_id');
    }

    // TODO:: Confirm structure for this
    public function totalSold(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'edu_purchase_items');
    }
}
