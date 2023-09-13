<?php

namespace App\Models\EDU\Course;

use App\Models\Label\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    protected $guarded = [];

    protected $casts = [];

    public function labels(): HasMany
    {
        return $this->hasMany(Label::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
