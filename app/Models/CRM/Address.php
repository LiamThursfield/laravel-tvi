<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;

    protected $table = 'crm_addresses';

    protected $guarded = [];

    protected $casts = [
    ];

    public function addressable(): ?MorphTo
    {
        return $this->morphTo() ?? null;
    }
}
