<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Announcement\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::factory()->count(2)->create();
    }
}
