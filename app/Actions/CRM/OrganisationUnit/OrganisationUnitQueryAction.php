<?php

namespace App\Actions\CRM\OrganisationUnit;

use App\Actions\AbstractQueryAction;
use App\Models\CRM\OrganisationUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class OrganisationUnitQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_equals = [
        'company_id'    => 'organisation_unit_company_id',
        'location_id'   => 'organisation_unit_location_id',
        'parent_id'     => 'organisation_unit_parent_id',
        'type'          => 'organisation_unit_type',
    ];

    protected array $searchable_fields_likes = [
        'email'     => 'organisation_unit_email',
        'name'      => 'organisation_unit_name',
        'telephone' => 'organisation_unit_telephone',
        'slug'      => 'organisation_unit_slug'
    ];

    protected string $order_by = 'name';


    protected function addOrderOptions()
    {
        $order_by = Arr::get($this->search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($this->search_options, 'order_direction', $this->order_direction);

        $this->query->orderBy($order_by, $order_direction);
    }

    protected function getQueryBuilder(): Builder
    {
        return OrganisationUnit::query();
    }
}
