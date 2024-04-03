<?php

use App\Interfaces\ThemeInterface;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add(
            'theme.colors',
            ThemeInterface::DEFAULT_COLORS
        );

        $this->migrator->add(
            'theme.favicon_url',
            null
        );

        $this->migrator->add(
            'theme.logo_url',
            null
        );

        $this->migrator->add(
            'theme.site_name',
            null
        );

        $this->migrator->add(
            'theme.primary',
            null
        );
    }
};
