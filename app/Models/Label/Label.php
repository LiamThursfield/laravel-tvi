<?php

namespace App\Models\Label;

use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    public function courses() : BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
