<?php

namespace App\Actions\EDU\Lecture\Student;

use App\Models\EDU\Lecture\Lecture;
use Illuminate\Support\Facades\Auth;

class LectureCompleteAction
{
    public function handle(Lecture $lecture): void
    {
        $lecture->users()->attach(Auth::id(), ['completed' => true]);
    }
}
