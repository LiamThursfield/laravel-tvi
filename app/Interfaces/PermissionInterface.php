<?php

namespace App\Interfaces;

class PermissionInterface
{
    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ]
    ];
}
