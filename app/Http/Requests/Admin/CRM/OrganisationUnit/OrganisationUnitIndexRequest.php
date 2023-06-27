<?php

namespace App\Http\Requests\Admin\CRM\OrganisationUnit;

use App\Http\Requests\BaseIndexRequest;
use App\Interfaces\CRM\OrganisationUnitInterface;
use Illuminate\Validation\Rule;

class OrganisationUnitIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'organisation_unit_company_id'      => 'nullable|integer|references:crm_organisation_units,id',
            'organisation_unit_location_id'     => 'nullable|integer|references:crm_organisation_units,id',
            'organisation_unit_email'           => 'nullable|string',
            'organisation_unit_name'            => 'nullable|string',
            'organisation_unit_parent_id'       => 'nullable|integer|references:crm_organisation_units,id',
            'organisation_unit_slug'            => 'nullable|string',
            'organisation_unit_telephone'       => 'nullable|string',
            'organisation_unit_type'            => [
                'nullable',
                Rule::in(OrganisationUnitInterface::TYPE_ENUM),
            ],
        ]);
    }
}
