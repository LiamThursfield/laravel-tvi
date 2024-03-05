<?php

namespace App\Models\EDU\Section;

use App\Interfaces\EDU\Webinar\WebinarInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Webinar\Webinar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_sections';

    protected $guarded = [];

    protected $casts = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function webinars(): HasMany
    {
        return $this->hasMany(Webinar::class)->where('status', WebinarInterface::STATUS_PUBLISHED);
    }

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class)
            ->orderBy('index');
    }

    public function lecturesCompleted(): HasMany
    {
        return $this->hasMany(Lecture::class)
            ->where('');
    }

    public function childItems(): HasMany
    {
        return $this->hasMany(Lecture::class)
            ->with('files')
            ->orderBy('index');
    }
}
