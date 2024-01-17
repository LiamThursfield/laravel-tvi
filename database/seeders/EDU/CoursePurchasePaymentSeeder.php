<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Course\CoursePurchasePayment;
use Illuminate\Database\Seeder;

class CoursePurchasePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoursePurchasePayment::factory()->count(2)->create();
    }
}
