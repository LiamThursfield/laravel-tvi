<?php

namespace App\Models\EDU\Announcement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'edu_announcements';

    protected $guarded = [];

    protected $casts = [];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
