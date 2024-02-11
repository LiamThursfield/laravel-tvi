<?php

namespace App\Console\Commands\Landlord;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Stancl\Tenancy\Exceptions\DomainOccupiedByOtherTenantException;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super tenant';


    public function handle() : void
    {
        $id = $this->ask('What is the tenant id?');
        if (!$id) {
            $this->error('Tenant id is required.');
            return;
        }

        $id = Str::slug($id);
        if (Tenant::find($id)) {
            $this->error('Tenant already exists.');
            return;
        }

        $this->info('Creating the tenant database, this may take a while.');
        $tenant = Tenant::create(['id' => $id]);

        $domainCount = 0;
        do {
            $domain = $this->ask('Add a domain? (leave blank to skip)');
            if ($domain) {
                if ($this->addDomain($tenant, $domain)) {
                    $domainCount++;
                }
            } elseif ($domainCount < 1) {
                $this->error('At least one domain is required.');
            }
        } while ($domain || $domainCount < 1);

        $this->comment('Tenant Created: ' . $tenant->id . ' with ' . $domainCount . ' domains.');
    }


    protected function addDomain(Tenant $tenant, string $domain): bool
    {
        try {
            $tenant->domains()->create(['domain' => $domain]);
            return true;
        } catch (DomainOccupiedByOtherTenantException) {
            $this->error('Domain is already occupied.');
            return false;
        }
    }
}
