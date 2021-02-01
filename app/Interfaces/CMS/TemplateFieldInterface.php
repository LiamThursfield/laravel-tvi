<?php

namespace App\Interfaces\CMS;

class TemplateFieldInterface
{
    // Template field types
    const TYPE_CMS_MENU = 'cms_menu';
    const TYPE_IMAGE    = 'image';
    const TYPE_NUMBER   = 'number';
    const TYPE_TEXT     = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_WYSIWYG  = 'wysiwyg';

    const ALL_TYPES = [
        self::TYPE_CMS_MENU,
        self::TYPE_IMAGE,
        self::TYPE_NUMBER,
        self::TYPE_TEXT,
        self::TYPE_TEXTAREA,
        self::TYPE_WYSIWYG,
    ];

    // Labelled types - typically used for showing the types to a user
    const ALL_TYPES_LABELLED = [
        self::TYPE_CMS_MENU => "CMS Menu",
        self::TYPE_IMAGE    => "Image",
        self::TYPE_NUMBER   => "Number",
        self::TYPE_TEXT     => "Text",
        self::TYPE_TEXTAREA => "Text Area",
        self::TYPE_WYSIWYG  => "WYSIWYG",
    ];


    // Default settings for each type
    const SETTINGS = [
        self::TYPE_CMS_MENU => [],
        self::TYPE_IMAGE    => [],
        self::TYPE_NUMBER   => [
            'min' => null,
            'max' => null,
        ],
        self::TYPE_TEXT     => [
            'max_length' => null,
        ],
        self::TYPE_TEXTAREA => [
            'max_length' => null,
            'rows'       => null,
        ],
        self::TYPE_WYSIWYG  => [],
    ];


    // Table/Model field helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_SLUG_MAX_LENGTH = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
    const FIELD_TYPE_MAX_LENGTH = 50;
}
