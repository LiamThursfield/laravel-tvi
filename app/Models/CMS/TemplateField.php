<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class TemplateField extends Model
{
    protected $table = 'cms_template_fields';

    protected $guarded = [];

    protected $casts = [
        'is_required'   => 'boolean',
        'settings'      => 'json',
    ];

    protected function template()
    {
        return $this->belongsTo(Template::class);
    }
}
