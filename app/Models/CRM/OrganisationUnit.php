<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganisationUnit extends Model
{
    use HasFactory;

    protected $table = 'crm_organisation_units';

    protected $guarded = [];

    protected $casts = [
        'notification_emails' => 'array',
        'socials' => 'json'
    ];

    public function address(): ?BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function children(): ?HasMany
    {
        return $this->hasMany(OrganisationUnit::class, 'parent_id');
    }

    public function company(): ?BelongsTo
    {
        return $this->belongsTo(OrganisationUnit::class);
    }

    public function location(): ?BelongsTo
    {
        return $this->belongsTo(OrganisationUnit::class);
    }

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(OrganisationUnit::class);
    }
}
