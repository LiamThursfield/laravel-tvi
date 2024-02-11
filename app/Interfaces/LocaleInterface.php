<?php

namespace App\Interfaces;

use Illuminate\Support\Arr;

class LocaleInterface
{
    const LOCALE_EN = 'en';
    const LOCALE_RO = 'ro';

    const ALL_LOCALES = [
        self::LOCALE_EN => 'English',
        self::LOCALE_RO => 'Romanian',
    ];
}
