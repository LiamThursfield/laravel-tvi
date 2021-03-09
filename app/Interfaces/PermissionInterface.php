<?php

namespace App\Interfaces;

/**
 * Interface to define core system Permissions
 *
 * When adding a new Permission:
 *      - Add a new const for the permission
 *          - For the name: use the format {ACTION}_{SUBJECT} e.g. VIEW_USERS
 *          - For the value: Use the format {action} {subject} e.g. view users
 *
 *      - Add the permission to the ALL_PERMISSIONS const
 *          - Use the format {subject} => [{action} => {permission constant}] e.g. 'users' => ['view' => self::VIEW_USERS]
 *
 */
class PermissionInterface
{
    // CMS Permissions
    const CREATE_CMS  = 'create cms';
    const DELETE_CMS  = 'delete cms';
    const EDIT_CMS    = 'edit cms';
    const VIEW_CMS    = 'view cms';

    // Advanced CMS Permissions
    const CREATE_CMS_ADVANCED  = 'create cms_advanced';
    const DELETE_CMS_ADVANCED  = 'delete cms_advanced';
    const EDIT_CMS_ADVANCED    = 'edit cms_advanced';
    const VIEW_CMS_ADVANCED    = 'view cms_advanced';

    // CRM Contacts Permissions
    const CREATE_CRM_CONTACTS    = 'create crm_contacts';
    const DELETE_CRM_CONTACTS    = 'delete crm_contacts';
    const EDIT_CRM_CONTACTS      = 'edit crm_contacts';
    const VIEW_CRM_CONTACTS      = 'view crm_contacts';

    // CRM Form Submission Permissions
    const VIEW_CRM_FORM_SUBMISSIONS = 'view crm_form_permissions';

    // CRM Forms Permissions
    const CREATE_CRM_FORMS    = 'create crm_forms';
    const DELETE_CRM_FORMS    = 'delete crm_forms';
    const EDIT_CRM_FORMS      = 'edit crm_forms';
    const VIEW_CRM_FORMS      = 'view crm_forms';

    // File Manager Permissions
    const EDIT_FILE_MANAGER = 'edit file_manager';
    const VIEW_FILE_MANAGER = 'view file_manager';

    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // Telescope Permissions
    const VIEW_TELESCOPE = 'view telescope';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'cms' => [
            'create'    => self::CREATE_CMS,
            'delete'    => self::DELETE_CMS,
            'edit'      => self::EDIT_CMS,
            'view'      => self::VIEW_CMS,
        ],
        'cms_advanced' => [
            'create'    => self::CREATE_CMS_ADVANCED,
            'delete'    => self::DELETE_CMS_ADVANCED,
            'edit'      => self::EDIT_CMS_ADVANCED,
            'view'      => self::VIEW_CMS_ADVANCED,
        ],
        'crm_contacts' => [
            'create'    => self::CREATE_CRM_CONTACTS,
            'delete'    => self::DELETE_CRM_CONTACTS,
            'edit'      => self::EDIT_CRM_CONTACTS,
            'view'      => self::VIEW_CRM_CONTACTS,
        ],
        'crm_form_submissions' => [
            'view'  => self::VIEW_CRM_FORM_SUBMISSIONS,
        ],
        'crm_forms' => [
            'create'    => self::CREATE_CRM_FORMS,
            'delete'    => self::DELETE_CRM_FORMS,
            'edit'      => self::EDIT_CRM_FORMS,
            'view'      => self::VIEW_CRM_FORMS,
        ],
        'file_manager' => [
            'edit' => self::EDIT_FILE_MANAGER,
            'view' => self::VIEW_FILE_MANAGER,
        ],
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'telescope' => [
            'view'  => self::VIEW_TELESCOPE
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ]
    ];

    static function getMiddlewareString($permissions)
    {
        if (is_array($permissions)) {
            $permissions = implode(',', $permissions);
        }

        return 'can:' . $permissions;
    }
}
