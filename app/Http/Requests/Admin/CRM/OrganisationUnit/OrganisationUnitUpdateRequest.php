<?php

namespace App\Http\Requests\Admin\CRM\OrganisationUnit;

use Illuminate\Validation\Rule;

class OrganisationUnitUpdateRequest extends OrganisationUnitStoreRequest
{
    public function rules() : array
    {
        $rules = parent::rules();

        $rules['slug'] = [
            'required',
            'string',
            Rule::unique('crm_organisation_units')->ignore($this->organisation_unit->id, 'id'),
        ];

        return $rules;
    }
}
