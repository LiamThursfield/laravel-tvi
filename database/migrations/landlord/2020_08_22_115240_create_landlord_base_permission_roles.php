<?php

use App\Interfaces\Landlord\PermissionInterface;
use App\Interfaces\Landlord\RoleInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Migration to create the base Permissions and Roles
 *
 * When adding a new Permission:
 *      - Add it to the PermissionInterface class
 *      - Add it to the getNewPermissions() function in this migration
 *      - Add it to any applicable Roles in the getNewRoles() function in this migration
 *
 * When adding a new Role
 *      - Add it to the RoleInterface class
 *      - Add it to the getNewPRoles() function in this migration, along with any Permissions
 *
 */
class CreateLandlordBasePermissionRoles extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $originalDriver = auth()->getDefaultDriver();
        auth()->setDefaultDriver('web');

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create the new permissions
        $permissions = $this->getNewPermissions()->map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'landlord-web'
            ];
        });
        DB::table('permissions')->insert($permissions->toArray());

        // Create the new roles and assign any permissions
        foreach ($this->getNewRoles() as $role_name => $permissions) {
            $role = Role::create(['guard_name' => 'landlord-web', 'name' => $role_name]);
            // Assign the permissions to the role
            $role->givePermissionTo($permissions);
        }

        auth()->setDefaultDriver($originalDriver);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Delete the new Permissions and Roles
        Permission::whereIn('name', $this->getNewPermissions()->toArray())->delete();
        Role::whereIn('name', array_keys($this->getNewRoles()->toArray()))->delete();
    }


    /**
     * New Permissions being added in the migration
     *
     * @return Collection<string>
     */
    protected function getNewPermissions(): Collection
    {
        return collect([
            // Admin
            PermissionInterface::VIEW_ADMIN,

            // Profile
            PermissionInterface::EDIT_PROFILE,
            PermissionInterface::VIEW_PROFILE,

            // Settings
            PermissionInterface::EDIT_SETTINGS,
            PermissionInterface::VIEW_SETTINGS,

            // Telescope
            PermissionInterface::VIEW_TELESCOPE,

            // Tenants
            PermissionInterface::CREATE_TENANTS,
            PermissionInterface::DELETE_TENANTS,
            PermissionInterface::EDIT_TENANTS,
            PermissionInterface::VIEW_TENANTS,

            // Users
            PermissionInterface::CREATE_USERS,
            PermissionInterface::DELETE_USERS,
            PermissionInterface::EDIT_USERS,
            PermissionInterface::VIEW_USERS,
        ]);
    }

    /**
     * New Roles with the associated permissions
     *
     * @return Collection<string, array<string>>
     */
    protected function getNewRoles(): Collection
    {
        return collect([
            RoleInterface::ADMIN => [
                // Admin
                PermissionInterface::VIEW_ADMIN,
                // Profile
                PermissionInterface::EDIT_PROFILE,
                PermissionInterface::VIEW_PROFILE,
                // Settings
                PermissionInterface::VIEW_SETTINGS,
                // Tenants
                PermissionInterface::VIEW_TENANTS,
                // Users
                PermissionInterface::CREATE_USERS,
                PermissionInterface::DELETE_USERS,
                PermissionInterface::EDIT_USERS,
                PermissionInterface::VIEW_USERS,
            ],
            RoleInterface::SUPER => [],
        ]);
    }
}
