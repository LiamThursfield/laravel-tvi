<?php

use App\Interfaces\LocaleInterface;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('core.locale', LocaleInterface::LOCALE_EN);
    }
};
