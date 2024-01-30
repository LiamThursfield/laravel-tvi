<?php

namespace App\Providers;

use App\Interfaces\RoleInterface;
use App\Interfaces\Landlord\RoleInterface as LandlordRoleInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Implicitly grant "Super" role all permissions
        Gate::before(function ($user, $ability) {
            return (
                $user->hasRole(RoleInterface::SUPER) ||
                $user->hasRole(LandlordRoleInterface::SUPER)
            ) ? true : null;
        });
    }
}
