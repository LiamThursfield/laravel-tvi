<?php

namespace App\Actions\EDU\Programme;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Programme\Programme;

class ProgrammePublishAction
{
    public function handle(Programme $programme)
    {
        return Programme::where('id', $programme->id)
            ->update(['status'=> CourseInterface::STATUS_PUBLISHED]);
    }
}
