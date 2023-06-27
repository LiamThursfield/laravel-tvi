<?php

namespace App\Interfaces\CRM;

class OrganisationUnitInterface
{
    // Table/Model Field Helpers
    const FIELD_TELEPHONE_MAX_LENGTH = 20;

    // Table/Model Enums
    const TYPE_COMPANY      = 'company';
    const TYPE_LOCATION     = 'location';
    const TYPE_DEPARTMENT   = 'department';

    const TYPE_ENUM = [
        self::TYPE_COMPANY,
        self::TYPE_LOCATION,
        self::TYPE_DEPARTMENT,
    ];

    const TYPE_LABELS = [
        self::TYPE_COMPANY      => 'Company',
        self::TYPE_LOCATION     => 'Location',
        self::TYPE_DEPARTMENT   => 'Department',
    ];
}
