<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Lecture\Lecture;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecture::factory()->count(2)->create();
    }
}
