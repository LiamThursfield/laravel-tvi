<?php

namespace App\Models\EDU\Section;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionFiles extends Model
{
    use HasFactory;

    protected $table = 'edu_section_files';

    protected $guarded = [];

    protected $casts = [];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
