<?php

namespace Database\Seeders\EDU;

use App\Interfaces\EDU\Purchase\PurchaseInterface;
use App\Interfaces\RoleInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Purchase\Purchase;
use App\Models\EDU\Purchase\PurchaseItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Redeemed purchases
        for ($x = 0; $x < 5; $x++) {
            $user = User::factory()->create([
                'email' => "student_{$x}@example.com",
                'password' => Hash::make('StudentPassword')
            ]);
            $user->assignRole(Role::whereName(RoleInterface::STUDENT)->first());

            $purchases = Purchase::factory()->count(1)->create([
                'redeemed_at' => now(),
                'email_address' => $user->email,
                'is_refundable' => true,
                'user_id' => $user->id,
                'payment_status' => PurchaseInterface::PAYMENT_STATUS_PAID,
            ]);

            $this->addItemsToPurchases($purchases, $user);
        }

        // Unredeemed purchases
        for ($x = 0; $x < 5; $x++) {
            $purchases = Purchase::factory()->count(5)->create([
                'email_address' => null,
                'redeemed_at' => null,
            ]);

            $this->addItemsToPurchases($purchases);
        }
    }

    protected function addItemsToPurchases($purchases, User $user = null)
    {
        foreach ($purchases as $purchase) {
            $items = PurchaseItem::factory()->count(1)->create([
                'purchase_id' => $purchase->id,
                'purchasable_id' => Course::inRandomOrder()->first(),
                'purchasable_type' => Course::class,
            ]);

            if ($user) {
                foreach ($items as $item) {
                    $item->redeem($user);
                }
            }
        }
    }
}
