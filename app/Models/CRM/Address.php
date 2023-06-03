<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;

    protected $table = 'crm_addresses';

    protected $guarded = [];

    protected $casts = [
    ];

    public function contact(): ?BelongsTo
    {
        return $this->belongsTo(Contact::class) ?? null;
    }
}
