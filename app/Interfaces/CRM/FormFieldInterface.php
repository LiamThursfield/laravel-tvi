<?php

namespace App\Interfaces\CRM;

use Illuminate\Support\Arr;

class FormFieldInterface
{
    // CRM Form Field Types
    const TYPE_CRM_EMAIL        = 'crm_email';
    const TYPE_CRM_FIRST_NAME   = 'crm_first_name';
    const TYPE_CRM_LAST_NAME    = 'crm_last_name';
    const TYPE_CRM_TITLE        = 'crm_title';
    const TYPE_CRM_TELEPHONE    = 'crm_telephone';

    const ALL_CRM_TYPES = [
        self::TYPE_CRM_EMAIL,
        self::TYPE_CRM_FIRST_NAME,
        self::TYPE_CRM_LAST_NAME,
        self::TYPE_CRM_TELEPHONE,
        self::TYPE_CRM_TITLE,
    ];

    // The value is the name of the field in the contact model
    const ALL_CRM_TYPES_MAPPED = [
        self::TYPE_CRM_EMAIL        => 'email',
        self::TYPE_CRM_FIRST_NAME   => 'first_name',
        self::TYPE_CRM_LAST_NAME    => 'last_name',
        self::TYPE_CRM_TELEPHONE    => 'telephone',
        self::TYPE_CRM_TITLE        => 'title',
    ];

    // Standard Form Field Types
    const TYPE_EMAIL    = 'email';
    const TYPE_NUMBER   = 'number';
    const TYPE_TEXT     = 'text';
    const TYPE_TEXTAREA = 'textarea';

    const ALL_STANDARD_TYPES = [
        self::TYPE_EMAIL,
        self::TYPE_NUMBER,
        self::TYPE_TEXT,
        self::TYPE_TEXTAREA,
    ];

    const ALL_TYPES_LABELLED = [
        self::TYPE_CRM_EMAIL        => 'CRM Email',
        self::TYPE_CRM_FIRST_NAME   => 'CRM First Name',
        self::TYPE_CRM_LAST_NAME    => 'CRM Last Name',
        self::TYPE_CRM_TITLE        => 'CRM Title',
        self::TYPE_CRM_TELEPHONE    => 'CRM Telephone',
        self::TYPE_EMAIL            => 'Email',
        self::TYPE_NUMBER           => 'Number',
        self::TYPE_TEXT             => 'Text',
        self::TYPE_TEXTAREA         => 'Textarea',
    ];

    // Default settings for each type
    const TYPE_SETTINGS = [
        self::TYPE_CRM_EMAIL        => [],
        self::TYPE_CRM_FIRST_NAME   => [],
        self::TYPE_CRM_LAST_NAME    => [],
        self::TYPE_CRM_TITLE        => [],
        self::TYPE_CRM_TELEPHONE    => [],
        self::TYPE_EMAIL            => [],
        self::TYPE_NUMBER           => [
            'min' => null,
            'max' => null,
        ],
        self::TYPE_TEXT             => [
            'max_length' => null,
        ],
        self::TYPE_TEXTAREA         => [
            'max_length' => null,
            'rows'       => null,
        ],
    ];


    // Table/Model Field Helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_SLUG_MAX_LENGTH = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
    const FIELD_TYPE_MAX_LENGTH = 50;


    static function getAllTypes() : array
    {
        return array_merge(
            self::ALL_CRM_TYPES,
            self::ALL_STANDARD_TYPES
        );
    }

    static function getAllCrmTypesLabelled() : array
    {
        return self::getTypesLabelled(self::ALL_CRM_TYPES);
    }

    static function getAllStandardTypesLabelled() : array
    {
        return self::getTypesLabelled(self::ALL_STANDARD_TYPES);
    }

    private static function getTypesLabelled(array $types_array) : array
    {
        $types = [];

        foreach ($types_array as $type) {
            $types[$type] = Arr::get(self::ALL_TYPES_LABELLED, $type, $type);
        }

        return $types;
    }
}
