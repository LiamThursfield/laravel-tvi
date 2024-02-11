<?php

namespace App\Bootstrappers;

use Illuminate\Support\Facades\App;
use Spatie\LaravelSettings\Exceptions\MissingSettings;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class ConfigTenancyBootstrapper implements TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant)
    {
        try {
            App::setLocale($tenant->locale);
        } catch (MissingSettings $e) {
            // For initial migration of setting, this may not be set. No need to fail
        }
    }

    public function revert()
    {
        App::setLocale(config('app.landlord.locale'));
    }

}
