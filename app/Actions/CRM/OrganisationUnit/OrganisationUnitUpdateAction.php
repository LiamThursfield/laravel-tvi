<?php

namespace App\Actions\CRM\OrganisationUnit;

use App\Models\CRM\OrganisationUnit;

class OrganisationUnitUpdateAction
{
    public function handle(OrganisationUnit $organisation_unit, array $organisation_unit_data, bool $refresh = false) : OrganisationUnit
    {
        $organisation_unit->update($organisation_unit_data);

        if ($refresh) {
            $organisation_unit->refresh();
        }

        return $organisation_unit;
    }
}
