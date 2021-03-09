<?php

namespace App\Interfaces\CRM;

class FormInterface
{
    // Table/Model Field Helpers
    const FIELD_NAME_MAX_LENGTH             = 120;
    const FIELD_SLUG_MAX_LENGTH             = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
    const FIELD_SUCCESS_MESSAGE_MAX_LENGTH  = 1024;
    const FIELD_REDIRECT_URL_MAX_LENGTH     = 150;
}
