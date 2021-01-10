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
