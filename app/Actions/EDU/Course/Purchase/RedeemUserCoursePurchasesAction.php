<?php

namespace App\Actions\EDU\Course\Purchase;

use App\Models\EDU\Course\CoursePurchase;
use App\Models\User;

class RedeemUserCoursePurchasesAction
{
    public function handle(User $user)
    {
        // Set the user id for any existing purchases with the user's email
        CoursePurchase::whereNull('user_id')
            ->where('email_address', $user->email)
            ->update(['user_id' => $user->id]);

        // Attach purchased courses to the user
        $user->coursePurchases()
            ->where('payment_status', 'PAID')
            ->whereNull('redeemed_at')
            ->get()->each(function (CoursePurchase $purchase) use ($user) {
                $purchase->redeem($user);
            });
    }
}
