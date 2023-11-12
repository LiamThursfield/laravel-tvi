<?php

namespace App\Models\EDU\Lecture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LectureFiles extends Model
{
    use HasFactory;

    protected $table = 'edu_lecture_files';

    protected $guarded = [];

    protected $casts = [];

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }
}
