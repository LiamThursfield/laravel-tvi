<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Programme\Programme;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Programme::factory()->count(2)->create();
    }
}
