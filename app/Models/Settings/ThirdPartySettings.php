<?php

namespace App\Models\Settings;

use Spatie\LaravelSettings\Settings;

class ThirdPartySettings extends Settings
{
    public string $stripe_publishable_key;

    public string $stripe_secret_key;


    public static function group(): string
    {
        return 'thirdParty';
    }
}