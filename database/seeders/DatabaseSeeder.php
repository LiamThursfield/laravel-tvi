<?php

namespace Database\Seeders;

use Database\Seeders\Landlord\UserRoleSeeder as LandlordUserRoleSeeder;
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
        $this->call(LandlordUserRoleSeeder::class);
    }
}
