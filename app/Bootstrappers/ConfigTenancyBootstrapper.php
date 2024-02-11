<?php

namespace App\Bootstrappers;

use Illuminate\Support\Facades\App;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class ConfigTenancyBootstrapper implements TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant)
    {
        App::setLocale($tenant->locale);
    }

    public function revert()
    {
        App::setLocale(config('app.landlord.locale'));
    }

}
