<?php

namespace App\Models\EDU\Lecture;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LectureUser extends Model
{
    use HasFactory;

    protected $table = 'edu_lecture_users';

    protected $guarded = [];

    protected $casts = [];

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
