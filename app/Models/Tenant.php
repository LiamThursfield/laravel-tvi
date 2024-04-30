<?php

namespace App\Models;

use App\Models\Settings\CoreSettings;
use Exception;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

/**
 *
 * @property string $id
 * @property string $locale
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public function getLocaleAttribute(): string
    {
        try {
            return app()->make(CoreSettings::class)->locale;
        } catch (Exception $e) {
            // For when a tenant is being created
            return 'en';
        }
    }
}
