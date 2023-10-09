<?php

namespace App\Models\EDU\Course;

use App\Models\EDU\Label\Label;
use App\Models\EDU\Programme\Programme;
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
