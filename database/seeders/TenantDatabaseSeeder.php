<?php

namespace Database\Seeders;

use Database\Seeders\EDU\AnnouncementSeeder;
use Database\Seeders\EDU\CourseInstalmentPlanSeeder;
use Database\Seeders\EDU\CoursePurchasePaymentSeeder;
use Database\Seeders\EDU\CoursePurchaseSeeder;
use Database\Seeders\EDU\CourseSeeder;
use Database\Seeders\EDU\LabelSeeder;
use Database\Seeders\EDU\ProgrammeSeeder;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
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
            $this->call(CourseInstalmentPlanSeeder::class);
            $this->call(CoursePurchasePaymentSeeder::class);
            $this->call(CoursePurchaseSeeder::class);

            $this->call(ThirdPartySettingSeeder::class);
    }
}
