<?php

namespace App\Models\CRM;

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
        'email_recipients'      => 'array',
        'marketing_email'       => 'boolean',
        'marketing_sms'         => 'boolean',
        'marketing_telephone'   => 'boolean',
    ];


    public function formFields() : HasMany
    {
        return $this->hasMany(FormField::class);
    }

    public function formSubmissions() : HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

}
