<?php

namespace App\Interfaces\Landlord;

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
    // Admin Permissions
    const VIEW_ADMIN = 'view admin';

    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // Setting Permissions
    const EDIT_SETTINGS = 'edit settings';
    const VIEW_SETTINGS = 'view settings';

    // Telescope Permissions
    const VIEW_TELESCOPE = 'view telescope';

    // Tenant Permissions
    const CREATE_TENANTS  = 'create tenants';
    const DELETE_TENANTS  = 'delete tenants';
    const EDIT_TENANTS    = 'edit tenants';
    const VIEW_TENANTS    = 'view tenants';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'admin' => [
            'view' => self::VIEW_ADMIN,
        ],
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'settings' => [
            'edit' => self::EDIT_SETTINGS,
            'view' => self::VIEW_SETTINGS,
        ],
        'telescope' => [
            'view'  => self::VIEW_TELESCOPE
        ],
        'tenants' => [
            'create'    => self::CREATE_TENANTS,
            'delete'    => self::DELETE_TENANTS,
            'edit'      => self::EDIT_TENANTS,
            'view'      => self::VIEW_TENANTS,
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ],
    ];

    static function getMiddlewareString($permissions)
    {
        if (is_array($permissions)) {
            $permissions = implode(',', $permissions);
        }

        return 'can:' . $permissions;
    }
}
