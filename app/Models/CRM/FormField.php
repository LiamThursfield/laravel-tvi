<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormField extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'crm_form_fields';

    protected $guarded = [];

    protected $casts = [
        'is_required'   => 'boolean',
        'settings'      => 'json',
    ];

    protected static function booted()
    {
        // Ensure FormFields are ordered via their order field by default
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    protected function form() : BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

}
