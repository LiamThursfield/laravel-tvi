<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormSubmission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'crm_form_submissions';

    protected $guarded = [];

    protected $casts = [
        'data'          => 'json',
        'submitted_at'  => 'datetime',
    ];


    public function contact() : BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
