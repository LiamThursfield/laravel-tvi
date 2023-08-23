<?php

namespace App\Http\Requests\Admin\CRM\OrganisationUnit;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CRM\OrganisationUnitInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class OrganisationUnitStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'address_id' => [
                'sometimes',
                'nullable',
                Rule::exists('crm_addresses', 'id'),
            ],
            'company_id' => [
                'required_unless:type,' . OrganisationUnitInterface::TYPE_COMPANY,
                'nullable',
                'integer',
                Rule::exists('crm_organisation_units', 'id')->where(function (Builder $query) {
                    return $query->where('type', OrganisationUnitInterface::TYPE_COMPANY);
                }),
            ],
            'email' => 'required|email',
            'name' => 'required|string',
            'location_id' => [
                'required_if:type,' . OrganisationUnitInterface::TYPE_DEPARTMENT,
                'nullable',
                'integer',
                Rule::exists('crm_organisation_units', 'id')->where(function (Builder $query) {
                    return $query->where('type', OrganisationUnitInterface::TYPE_LOCATION);
                }),
            ],
            'notification_email' => 'nullable|array',
            'notification_email.*' => 'email',
            'parent_id' => [
                'required_unless:type,' . OrganisationUnitInterface::TYPE_COMPANY,
                'nullable',
                'integer',
                Rule::exists('crm_organisation_units', 'id'),
            ],
            'socials' => 'nullable|array',
            'slug' => [
                'required',
                'string',
                Rule::unique('crm_forms', 'slug'),
            ],
            'telephone' => 'nullable|string',
            'type' => [
                'required',
                Rule::in(OrganisationUnitInterface::TYPE_ENUM),
            ]
        ];
    }
}
