<?php

namespace App\Models\EDU\Webinar;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Section\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_webinars';

    protected $guarded = [];

    protected $casts = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'creator_id');
    }
}
