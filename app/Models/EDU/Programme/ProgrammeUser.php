<?php

namespace App\Models\EDU\Programme;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgrammeUser extends Model
{
    use HasFactory;

    protected $table = 'edu_programme_users';

    protected $guarded = [];

    protected $casts = [];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
