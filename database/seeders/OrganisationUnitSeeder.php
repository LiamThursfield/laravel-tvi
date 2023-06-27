<?php

namespace Database\Seeders;

use App\Interfaces\CRM\OrganisationUnitInterface;
use App\Models\CRM\OrganisationUnit;
use Illuminate\Database\Seeder;

class OrganisationUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates a random number of companies, each with a random number of locations, each with a random number of departments
     *
     * @return void
     */
    public function run()
    {
        $companies = OrganisationUnit::factory(random_int(3, 6))->create([
            'type' => OrganisationUnitInterface::TYPE_COMPANY
        ]);

        foreach ($companies as $company) {
            $locations = OrganisationUnit::factory(random_int(2, 5))->create([
                'parent_id' => $company->id,
                'company_id' => $company->id,
                'type' => OrganisationUnitInterface::TYPE_LOCATION
            ]);

            foreach ($locations as $location) {
                OrganisationUnit::factory(random_int(1, 5))->create([
                    'parent_id' => $location->id,
                    'company_id' => $company->id,
                    'location_id' => $location->id,
                    'type' => OrganisationUnitInterface::TYPE_DEPARTMENT
                ]);
            }
        }
    }
}
