<?php

namespace App\Actions\EDU\Label;

use App\Models\EDU\Course\Course;

class LabelStoreAction
{
    public function handle(array $data) : Course
    {
        return Course::create($data);
    }
}
