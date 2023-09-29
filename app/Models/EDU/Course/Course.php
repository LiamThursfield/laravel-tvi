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

    public function labels(): HasMany
    {
        return $this->hasMany(Label::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function webinars(): HasMany
    {
        return $this->hasMany(Webinar::class);
    }
}
