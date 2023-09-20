<?php

namespace App\Models\EDU\Label;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Programme\Programme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_label';

    protected $guarded = [];

    protected $casts = [];

    public function courses() : BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function programmes() : BelongsToMany
    {
        return $this->belongsToMany(Programme::class);
    }
}
