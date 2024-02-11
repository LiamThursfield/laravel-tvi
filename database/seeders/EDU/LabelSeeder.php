<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Label\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Label::factory()->count(2)->create();
    }
}
