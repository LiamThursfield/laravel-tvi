<?php

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use Illuminate\Database\Migrations\Migration;
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
            // CMS
            PermissionInterface::CREATE_CMS,
            PermissionInterface::DELETE_CMS,
            PermissionInterface::EDIT_CMS,
            PermissionInterface::VIEW_CMS,
            // Advanced CMS
            PermissionInterface::CREATE_CMS_ADVANCED,
            PermissionInterface::DELETE_CMS_ADVANCED,
            PermissionInterface::EDIT_CMS_ADVANCED,
            PermissionInterface::VIEW_CMS_ADVANCED,
            // CRM Contacts
            PermissionInterface::CREATE_CRM_CONTACTS,
            PermissionInterface::DELETE_CRM_CONTACTS,
            PermissionInterface::EDIT_CRM_CONTACTS,
            PermissionInterface::VIEW_CRM_CONTACTS,
            // CRM Form Submissions
            PermissionInterface::VIEW_CRM_FORM_SUBMISSIONS,
            // CRM Forms
            PermissionInterface::CREATE_CRM_FORMS,
            PermissionInterface::DELETE_CRM_FORMS,
            PermissionInterface::EDIT_CRM_FORMS,
            PermissionInterface::VIEW_CRM_FORMS,
            // File Manager
            PermissionInterface::EDIT_FILE_MANAGER,
            PermissionInterface::VIEW_FILE_MANAGER,
            // Profile
            PermissionInterface::EDIT_PROFILE,
            PermissionInterface::VIEW_PROFILE,
            // Telescope
            PermissionInterface::VIEW_TELESCOPE,
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
                // CMS
                PermissionInterface::CREATE_CMS,
                PermissionInterface::DELETE_CMS,
                PermissionInterface::EDIT_CMS,
                PermissionInterface::VIEW_CMS,
                // Advanced CMS
                PermissionInterface::VIEW_CMS_ADVANCED,
                // CRM Contacts
                PermissionInterface::CREATE_CRM_CONTACTS,
                PermissionInterface::DELETE_CRM_CONTACTS,
                PermissionInterface::EDIT_CRM_CONTACTS,
                PermissionInterface::VIEW_CRM_CONTACTS,
                // CRM Form Submissions
                PermissionInterface::VIEW_CRM_FORM_SUBMISSIONS,
                // CRM Forms
                PermissionInterface::CREATE_CRM_FORMS,
                PermissionInterface::DELETE_CRM_FORMS,
                PermissionInterface::EDIT_CRM_FORMS,
                PermissionInterface::VIEW_CRM_FORMS,
                // File Manager
                PermissionInterface::EDIT_FILE_MANAGER,
                PermissionInterface::VIEW_FILE_MANAGER,
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
                // CMS
                PermissionInterface::VIEW_CMS,
                // File Manager
                PermissionInterface::VIEW_FILE_MANAGER,
                // Profile
                PermissionInterface::VIEW_PROFILE,
            ],
        ];
    }


}
