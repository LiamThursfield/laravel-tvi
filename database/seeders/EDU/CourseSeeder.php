<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Course\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory()->count(2)->create();
    }
}
