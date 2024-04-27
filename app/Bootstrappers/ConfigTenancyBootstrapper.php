<?php

namespace App\Bootstrappers;

use App\Traits\Base\ManagesTenancyMailer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Spatie\LaravelSettings\Exceptions\MissingSettings;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class ConfigTenancyBootstrapper implements TenancyBootstrapper
{
    use ManagesTenancyMailer;

    public function bootstrap(Tenant $tenant)
    {
        try {
            App::setLocale($tenant->locale);
            $this->setMailConfigForTenant($tenant);
        } catch (QueryException | MissingSettings $e) {
            // For initial migration of setting, this may not be set. No need to fail
        }
    }

    public function revert()
    {
        // Don't need to do anything here as there is no reverting in a single request to worry about
    }

}
