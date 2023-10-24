<?php

namespace Database\Seeders;

use App\Models\EDU\Purchase\Purchase;
use Database\Seeders\EDU\AnnouncementSeeder;
use Database\Seeders\EDU\CourseSeeder;
use Database\Seeders\EDU\LabelSeeder;
use Database\Seeders\EDU\ProgrammeSeeder;
use Database\Seeders\EDU\PurchaseSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            $this->call(UserRoleSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(TemplateSeeder::class);
            $this->call(FormSeeder::class);
            $this->call(OrganisationUnitSeeder::class);

            // EDU
            $this->call(AnnouncementSeeder::class);
            $this->call(LabelSeeder::class);
            $this->call(ProgrammeSeeder::class);
            $this->call(CourseSeeder::class);
//        $this->call(SectionSeeder::class);
//        $this->call(LectureSeeder::class);
//        $this->call(WebinarSeeder::class);
            $this->call(PurchaseSeeder::class);

            $this->call(ThirdPartySettingSeeder::class);
    }
}
