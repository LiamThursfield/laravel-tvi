<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'crm_contacts';

    protected $guarded = [];

    protected $appends = [
        'name',
        'name_with_title',
    ];

    protected $casts = [
        'marketing_email'       => 'boolean',
        'marketing_sms'         => 'boolean',
        'marketing_telephone'   => 'boolean',
    ];


    /**
     * Helper to return first + last name.
     * @return string
     */
    public function getNameAttribute() : String
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }

    /**
     * Helper to return title + first + last name.
     * @return string
     */
    public function getNameWithTitleAttribute() : String
    {
        return trim(($this->title ?? '') . ' ' . ($this->name));
    }


    public function formSubmissions() : HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }
}
