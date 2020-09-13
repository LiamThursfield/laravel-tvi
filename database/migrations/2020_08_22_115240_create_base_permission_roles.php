<?php

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreateBasePermissionRoles extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create the new permissions
        foreach ($this->getNewPermissions() as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create the new roles and assign any permissions
        foreach ($this->getNewRoles() as $role_name => $permissions) {
            $role = Role::create(['name' => $role_name]);
            // Assign the permissions to the role
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete the new Permissions and Roles
        Permission::whereIn('name', $this->getNewPermissions())->delete();
        Role::whereIn('name', array_keys($this->getNewRoles()))->delete();
    }


    /**
     * New Permissions being added in the migration
     *
     * @return array
     */
    protected function getNewPermissions()
    {
        return [
            // Profile
            PermissionInterface::EDIT_PROFILE,
            PermissionInterface::VIEW_PROFILE,
            // Users
            PermissionInterface::CREATE_USERS,
            PermissionInterface::DELETE_USERS,
            PermissionInterface::EDIT_USERS,
            PermissionInterface::VIEW_USERS,
        ];
    }

    /**
     * New Roles with the associated permissions
     *
     * @return array[]
     */
    protected function getNewRoles()
    {
        return [
            RoleInterface::ADMIN => [
                // Profile
                PermissionInterface::EDIT_PROFILE,
                PermissionInterface::VIEW_PROFILE,
                // Users
                PermissionInterface::CREATE_USERS,
                PermissionInterface::DELETE_USERS,
                PermissionInterface::EDIT_USERS,
                PermissionInterface::VIEW_USERS,
            ],
            RoleInterface::SUPER => [],
            RoleInterface::USER => [
                // Profile
                PermissionInterface::VIEW_PROFILE,
            ],
        ];
    }


}
