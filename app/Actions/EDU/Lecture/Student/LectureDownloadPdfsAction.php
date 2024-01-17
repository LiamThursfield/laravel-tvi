<?php

namespace App\Actions\EDU\Lecture\Student;

use App\Models\EDU\Lecture\Lecture;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LectureDownloadPdfsAction extends LectureCompleteAction
{
    public function handle(Lecture $lecture): void
    {
        /** @var User $user */
        $user = Auth::user();

        // check user has access
        $this->markCoursesAsNonRefundable($user, $lecture);

        // Log that the user has dld pdfs
        $lecture->users()->attach($user->id, ['completed' => true]);
    }
}
