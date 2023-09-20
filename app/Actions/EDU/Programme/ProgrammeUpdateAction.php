<?php

namespace App\Actions\EDU\Programme;

use App\Models\EDU\Programme\Programme;

class ProgrammeUpdateAction
{
    public function handle(Programme $course, array $data): ?Programme
    {
        $course->update($data);

        return $course->fresh();
    }
}
