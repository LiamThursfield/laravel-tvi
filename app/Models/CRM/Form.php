<?php

namespace App\Models\CRM;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property ?array<string> $email_recipients
 * @property bool $marketing_email
 * @property bool $marketing_sms
 * @property bool $marketing_telephone
 * @property ?string $submit_button_text
 * @property ?string $redirect_url
 * @property ?string $success_message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property ?Carbon $deleted_at
 * @property Collection<FormField> $formFields
 * @property Collection<FormSubmission> $formSubmissions
 */
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


    public function formFields(): HasMany
    {
        return $this->hasMany(FormField::class);
    }

    public function formSubmissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function hasEmailRecipients(): bool
    {
        return $this->email_recipients && count($this->email_recipients);
    }

}
