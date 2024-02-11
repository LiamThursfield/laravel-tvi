<?php

namespace App\Actions\EDU\Section;

use App\Models\EDU\Section\Section;

class SectionUpdateAction
{
    public function handle(Section $section, array $data): ?Section
    {
        $section->update($data);

        return $section->fresh();
    }
}
