<?php

namespace App\Models\EDU\Programme;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Label\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programme extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_programmes';

    protected $guarded = [];

    protected $casts = [];

    public function labels(): HasMany
    {
        return $this->hasMany(Label::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
