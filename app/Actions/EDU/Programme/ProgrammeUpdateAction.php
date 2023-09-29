<?php

namespace App\Actions\EDU\Programme;

use App\Models\EDU\Programme\Announcement;

class ProgrammeUpdateAction
{
    public function handle(Announcement $course, array $data): ?Announcement
    {
        $course->update($data);

        return $course->fresh();
    }
}
