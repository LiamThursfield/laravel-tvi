<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add(
            'edu.course_checkout_success_url',
            null
        );
        $this->migrator->add(
            'edu.course_checkout_cancel_url',
            null
        );
    }
};
