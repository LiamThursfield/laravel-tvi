<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'crm_forms';

    protected $guarded = [];

    protected $casts = [
        'email_recipients' => 'array',
    ];

    public function formFields() : HasMany
    {
        return $this->hasMany(FormField::class);
    }

}
