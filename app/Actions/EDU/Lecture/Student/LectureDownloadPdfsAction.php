<?php

namespace App\Actions\EDU\Lecture\Student;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Purchase\Purchase;
use App\Models\EDU\Purchase\PurchaseItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LectureDownloadPdfsAction
{
    public function handle(Lecture $lecture): void
    {
        $user = Auth::user();

        // check user has access
        $this->markCoursesAsNonRefundable($user, $lecture);

        // Log that the user has dld pdfs
        $lecture->users()->attach($user->id, ['completed' => true]);
    }
}
