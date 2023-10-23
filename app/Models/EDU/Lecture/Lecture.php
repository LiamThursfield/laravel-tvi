<?php

namespace App\Models\EDU\Lecture;

use App\Models\EDU\Section\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_lectures';

    protected $guarded = [];

    protected $casts = [
        'can_be_previewed' => 'bool'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'edu_lecture_users', 'lecture_id', 'user_id');
    }
}
