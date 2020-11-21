<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateField extends Model
{
    use HasFactory;

    protected $table = 'cms_template_fields';

    protected $guarded = [];

    protected $casts = [
        'is_required'   => 'boolean',
        'settings'      => 'json',
    ];

    protected static function booted()
    {
        // Ensure TemplateFields are ordered via their order field by default
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    protected function template()
    {
        return $this->belongsTo(Template::class);
    }
}
