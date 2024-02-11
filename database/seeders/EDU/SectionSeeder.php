<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Section\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::factory()->count(2)->create();
    }
}
