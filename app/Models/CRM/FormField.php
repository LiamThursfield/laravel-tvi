<?php

namespace App\Models\CRM;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $form_id
 * @property string $type
 * @property string $name
 * @property string $slug
 * @property bool $is_required
 * @property int $order
 * @property array $settings
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property ?Carbon $deleted_at
 * @property Form $form
 */
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
