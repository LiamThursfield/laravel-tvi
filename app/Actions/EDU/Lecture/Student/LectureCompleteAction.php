<?php

namespace App\Actions\EDU\Lecture\Student;

use App\Models\EDU\Course\CoursePurchase;
use App\Models\EDU\Lecture\Lecture;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LectureCompleteAction
{
    public function handle(Lecture $lecture): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->markCoursesAsNonRefundable($user, $lecture);
        $lecture->users()->attach($user->id, ['completed' => true]);
    }


    protected function markCoursesAsNonRefundable(User $user, Lecture $lecture): void
    {
        $purchases = CoursePurchase::where('user_id', $user->id)
            ->where('course_id', $lecture->section->course_id)
            ->get();

        foreach ($purchases as $purchase) {
            $purchase->is_refundable = false;
            $purchase->save();
        }
    }
}
