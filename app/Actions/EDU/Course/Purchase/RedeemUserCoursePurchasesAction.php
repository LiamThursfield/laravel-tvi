<?php

namespace App\Actions\EDU\Course\Purchase;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
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
            ->whereIn('status', [CoursePurchaseInterface::PAYMENT_STATUS_PAID, CoursePurchaseInterface::PAYMENT_STATUS_PARTIALLY_PAID])
            ->whereNull('redeemed_at')
            ->get()->each(function (CoursePurchase $purchase) use ($user) {
                $purchase->redeem($user);
            });
    }
}
