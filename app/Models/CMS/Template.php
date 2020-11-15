<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'cms_templates';

    protected $guarded = [];

    public function templateFields()
    {
        return $this->hasMany(TemplateField::class);
    }
}
