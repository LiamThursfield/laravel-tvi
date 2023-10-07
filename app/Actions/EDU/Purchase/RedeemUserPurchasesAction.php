<?php

namespace App\Actions\EDU\Purchase;

use App\Models\EDU\Purchase\Purchase;
use App\Models\EDU\Purchase\PurchaseItem;
use App\Models\User;

class RedeemUserPurchasesAction
{
    public function handle(User $user)
    {
        $user->purchases()->with('purchaseItems')
            ->where('payment_status', 'PAID')
            ->whereNull('redeemed_at')
            ->get()->each(function (Purchase $purchase) use ($user) {
                $purchase->purchaseItems->each(function (PurchaseItem $purchaseItem) use ($user) {
                    $purchaseItem->redeem($user);
                });
                $purchase->update(['redeemed_at' => now()]);
            });
    }
}