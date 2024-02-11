<?php

namespace App\Actions\EDU\Lecture;

use App\Models\EDU\Lecture\Lecture;

class LectureUpdateAction
{
    public function handle(Lecture $lecture, array $data): ?Lecture
    {
        $lecture->update($data);

        return $lecture->fresh();
    }
}
