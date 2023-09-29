<?php

namespace App\Models\EDU\Section;

use App\Models\EDU\Course\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
