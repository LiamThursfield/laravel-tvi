<?php

namespace App\Actions\EDU\Section;

use App\Models\EDU\Section\Section;
use Illuminate\Support\Str;

class SectionStoreAction
{
    public function handle(array $data) : Section
    {
        $data['slug'] = Str::slug($data['title']);

        return Section::create($data);
    }
}
