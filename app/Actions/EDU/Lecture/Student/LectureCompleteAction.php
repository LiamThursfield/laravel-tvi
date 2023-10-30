<?php

namespace App\Actions\EDU\Lecture\Student;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Purchase\Purchase;
use App\Models\EDU\Purchase\PurchaseItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LectureCompleteAction
{
    public function handle(Lecture $lecture): void
    {
        $user = Auth::user();

        $this->markCoursesAsNonRefundable($user, $lecture);
        $lecture->users()->attach($user->id, ['completed' => true]);
    }


    protected function markCoursesAsNonRefundable(User $user, Lecture $lecture)
    {
        $purchaseItems = PurchaseItem::where('purchasable_id', $lecture->section->course_id)
            ->where('purchasable_type', Course::class)
            ->pluck('purchase_id');

        $purchases = Purchase::where('user_id', $user->id)
            ->whereIn('id', $purchaseItems)
            ->get();

        foreach ($purchases as $purchase) {
            $purchase->is_refundable = false;
            $purchase->save();
        }
    }
}
