<?php

namespace Tests\Feature\Admin\CRM;

use App\Interfaces\CRM\OrganisationUnitInterface;
use App\Models\CRM\OrganisationUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Admin\AbstractAdminTestCase;

class OrganisationUnitTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_location_can_have_a_parent_company()
    {
        $company = OrganisationUnit::factory(['type' => OrganisationUnitInterface::TYPE_COMPANY])->create();

        $location = OrganisationUnit::factory([
            'type' => OrganisationUnitInterface::TYPE_LOCATION,
            'company_id' => $company->id
        ])->create();
    }
}
