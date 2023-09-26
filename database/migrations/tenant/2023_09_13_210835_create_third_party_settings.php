<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('thirdParty.stripe_publishable_key', '');
        $this->migrator->add('thirdParty.stripe_secret_key', '');
    }
};
