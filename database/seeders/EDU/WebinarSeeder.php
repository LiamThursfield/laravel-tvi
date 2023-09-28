<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Webinar\Webinar;
use Illuminate\Database\Seeder;

class WebinarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Webinar::factory()->count(2)->create();
    }
}
