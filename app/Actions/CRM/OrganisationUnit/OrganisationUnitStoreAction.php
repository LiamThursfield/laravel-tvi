<?php

namespace App\Actions\CRM\OrganisationUnit;

use App\Models\CRM\OrganisationUnit;

class OrganisationUnitStoreAction
{
    public function handle(array $organisation_unit_data) : OrganisationUnit
    {
        return OrganisationUnit::create($organisation_unit_data);
    }
}
