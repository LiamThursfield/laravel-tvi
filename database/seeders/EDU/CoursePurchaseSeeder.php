<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Course\CoursePurchase;
use Illuminate\Database\Seeder;

class CoursePurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoursePurchase::factory()->count(2)->create();
    }
}
