<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Course\CourseInstalmentPlan;
use Illuminate\Database\Seeder;

class CourseInstalmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseInstalmentPlan::factory()->count(2)->create();
    }
}
