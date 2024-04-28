<?php

namespace Tests;

use Database\Seeders\EmptySeeder;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\TenantDatabaseManagers\SQLiteDatabaseManager;

abstract class TenantTestCase extends TestCase
{

    /**
     * Create tenant and initialize tenancy?
     *
     * @var boolean
     */
    protected bool $tenancy = true;
    protected bool $shouldSeed = true;

    public function setUp(): void
    {
        parent::setUp();

        if (! $this->shouldSeed) {
            // Tell the package to use a seeder that does nothing
            config(['tenancy.seeder_parameters.--class' => EmptySeeder::class]);
        }

        if ($this->tenancy) {
            $tenant = $this->createTenant([], 'phpunit');
            tenancy()->initialize($tenant);

            config(['app.url' => 'http://phpunit.localhost']);

            /** @var UrlGenerator $urlGenerator */
            $urlGenerator = url();
            $urlGenerator->forceRootUrl('http://phpunit.localhost');

            $this->withServerVariables([
                'SERVER_NAME' => 'phpunit.localhost',
                'HTTP_HOST' => 'phpunit.localhost',
            ]);
        }
    }

    protected function tearDown(): void
    {
        if ($this->tenancy) {
            $this->tenant->delete();
            app(SQLiteDatabaseManager::class)->deleteDatabase($this->tenant);
            DB::purge('tenant');
        }
    }

}
