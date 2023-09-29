<?php

namespace Database\Seeders;

use Database\Seeders\EDU\AnnouncementSeeder;
use Database\Seeders\EDU\CourseSeeder;
use Database\Seeders\EDU\LabelSeeder;
use Database\Seeders\EDU\LectureSeeder;
use Database\Seeders\EDU\ProgrammeSeeder;
use Database\Seeders\EDU\SectionSeeder;
use Database\Seeders\EDU\WebinarSeeder;
use Illuminate\Database\Seeder;

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
        $this->call(SectionSeeder::class);
        $this->call(LectureSeeder::class);
        $this->call(WebinarSeeder::class);

         $this->call(ThirdPartySettingSeeder::class);
    }
}
