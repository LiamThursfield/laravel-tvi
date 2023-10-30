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
            // Admin
            PermissionInterface::VIEW_ADMIN,
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
            // CRM Organisation Units
            PermissionInterface::CREATE_CRM_ORGANISATION_UNITS,
            PermissionInterface::DELETE_CRM_ORGANISATION_UNITS,
            PermissionInterface::EDIT_CRM_ORGANISATION_UNITS,
            PermissionInterface::VIEW_CRM_ORGANISATION_UNITS,

            // EDU Courses
            PermissionInterface::CREATE_EDU_COURSES,
            PermissionInterface::DELETE_EDU_COURSES,
            PermissionInterface::EDIT_EDU_COURSES,
            PermissionInterface::VIEW_EDU_COURSES,
            PermissionInterface::PUBLISH_EDU_COURSES,

            // EDU PROGRAMS
            PermissionInterface::CREATE_EDU_PROGRAMMES,
            PermissionInterface::DELETE_EDU_PROGRAMMES,
            PermissionInterface::EDIT_EDU_PROGRAMMES,
            PermissionInterface::VIEW_EDU_PROGRAMMES,
            PermissionInterface::PUBLISH_EDU_PROGRAMMES,

            // EDU Labels
            PermissionInterface::CREATE_EDU_LABELS,
            PermissionInterface::DELETE_EDU_LABELS,
            PermissionInterface::EDIT_EDU_LABELS,
            PermissionInterface::VIEW_EDU_LABELS,

            // EDU Sections
            PermissionInterface::CREATE_EDU_SECTIONS,
            PermissionInterface::DELETE_EDU_SECTIONS,
            PermissionInterface::EDIT_EDU_SECTIONS,
            PermissionInterface::VIEW_EDU_SECTIONS,

            // EDU Lectures
            PermissionInterface::CREATE_EDU_LECTURES,
            PermissionInterface::DELETE_EDU_LECTURES,
            PermissionInterface::EDIT_EDU_LECTURES,
            PermissionInterface::VIEW_EDU_LECTURES,

            // EDU Webinars
            PermissionInterface::CREATE_EDU_WEBINARS,
            PermissionInterface::DELETE_EDU_WEBINARS,
            PermissionInterface::EDIT_EDU_WEBINARS,
            PermissionInterface::VIEW_EDU_WEBINARS,

            // EDU Announcements
            PermissionInterface::CREATE_EDU_ANNOUNCEMENTS,
            PermissionInterface::DELETE_EDU_ANNOUNCEMENTS,
            PermissionInterface::EDIT_EDU_ANNOUNCEMENTS,
            PermissionInterface::VIEW_EDU_ANNOUNCEMENTS,
            PermissionInterface::PUBLISH_EDU_ANNOUNCEMENTS,

            // EDU Purchases
            PermissionInterface::CREATE_EDU_PURCHASES,
            PermissionInterface::DELETE_EDU_PURCHASES,
            PermissionInterface::EDIT_EDU_PURCHASES,
            PermissionInterface::VIEW_EDU_PURCHASES,

            // File Manager
            PermissionInterface::EDIT_FILE_MANAGER,
            PermissionInterface::VIEW_FILE_MANAGER,
            // Profile
            PermissionInterface::EDIT_PROFILE,
            PermissionInterface::VIEW_PROFILE,
            // Settings
            PermissionInterface::EDIT_SETTINGS,
            PermissionInterface::VIEW_SETTINGS,
            // Telescope
            PermissionInterface::VIEW_TELESCOPE,
            // Users
            PermissionInterface::CREATE_USERS,
            PermissionInterface::DELETE_USERS,
            PermissionInterface::EDIT_USERS,
            PermissionInterface::VIEW_USERS,


            // Student
            PermissionInterface::VIEW_STUDENT_ADMIN,
            PermissionInterface::EDIT_STUDENT_ADMIN,
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
                // Admin
                PermissionInterface::VIEW_ADMIN,
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
                // CRM Organisation Units
                PermissionInterface::CREATE_CRM_ORGANISATION_UNITS,
                PermissionInterface::DELETE_CRM_ORGANISATION_UNITS,
                PermissionInterface::EDIT_CRM_ORGANISATION_UNITS,
                PermissionInterface::VIEW_CRM_ORGANISATION_UNITS,
                // File Manager
                PermissionInterface::EDIT_FILE_MANAGER,
                PermissionInterface::VIEW_FILE_MANAGER,
                // Profile
                PermissionInterface::EDIT_PROFILE,
                PermissionInterface::VIEW_PROFILE,
                // Settings
                PermissionInterface::EDIT_SETTINGS,
                PermissionInterface::VIEW_SETTINGS,
                // Users
                PermissionInterface::CREATE_USERS,
                PermissionInterface::DELETE_USERS,
                PermissionInterface::EDIT_USERS,
                PermissionInterface::VIEW_USERS,

                // EDU Courses
                PermissionInterface::CREATE_EDU_COURSES,
                PermissionInterface::DELETE_EDU_COURSES,
                PermissionInterface::EDIT_EDU_COURSES,
                PermissionInterface::VIEW_EDU_COURSES,
                PermissionInterface::PUBLISH_EDU_COURSES,

                // EDU PROGRAMS
                PermissionInterface::CREATE_EDU_PROGRAMMES,
                PermissionInterface::DELETE_EDU_PROGRAMMES,
                PermissionInterface::EDIT_EDU_PROGRAMMES,
                PermissionInterface::VIEW_EDU_PROGRAMMES,
                PermissionInterface::PUBLISH_EDU_PROGRAMMES,

                // EDU Labels
                PermissionInterface::CREATE_EDU_LABELS,
                PermissionInterface::DELETE_EDU_LABELS,
                PermissionInterface::EDIT_EDU_LABELS,
                PermissionInterface::VIEW_EDU_LABELS,

                // EDU Sections
                PermissionInterface::CREATE_EDU_SECTIONS,
                PermissionInterface::DELETE_EDU_SECTIONS,
                PermissionInterface::EDIT_EDU_SECTIONS,
                PermissionInterface::VIEW_EDU_SECTIONS,

                // EDU Lectures
                PermissionInterface::CREATE_EDU_LECTURES,
                PermissionInterface::DELETE_EDU_LECTURES,
                PermissionInterface::EDIT_EDU_LECTURES,
                PermissionInterface::VIEW_EDU_LECTURES,

                // EDU Webinars
                PermissionInterface::CREATE_EDU_WEBINARS,
                PermissionInterface::DELETE_EDU_WEBINARS,
                PermissionInterface::EDIT_EDU_WEBINARS,
                PermissionInterface::VIEW_EDU_WEBINARS,

                // EDU Announcements
                PermissionInterface::CREATE_EDU_ANNOUNCEMENTS,
                PermissionInterface::DELETE_EDU_ANNOUNCEMENTS,
                PermissionInterface::EDIT_EDU_ANNOUNCEMENTS,
                PermissionInterface::VIEW_EDU_ANNOUNCEMENTS,

                // EDU Purchases
                PermissionInterface::CREATE_EDU_PURCHASES,
                PermissionInterface::DELETE_EDU_PURCHASES,
                PermissionInterface::EDIT_EDU_PURCHASES,
                PermissionInterface::VIEW_EDU_PURCHASES,
            ],
            RoleInterface::SUPER => [],
            RoleInterface::USER => [
                // Admin
                PermissionInterface::VIEW_ADMIN,
                // CMS
                PermissionInterface::VIEW_CMS,
                // File Manager
                PermissionInterface::VIEW_FILE_MANAGER,
                // Profile
                PermissionInterface::VIEW_PROFILE,
            ],
            RoleInterface::STUDENT => [
                PermissionInterface::VIEW_STUDENT_ADMIN,
                PermissionInterface::EDIT_STUDENT_ADMIN,
            ]
        ];
    }


}
