<?php

namespace App\Models\Settings;

use Spatie\LaravelSettings\Settings;

class CoreSettings extends Settings
{
    public ?string $locale;


    public static function group(): string
    {
        return 'core';
    }
}
