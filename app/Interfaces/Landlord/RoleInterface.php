<?php

namespace App\Interfaces\Landlord;

use Illuminate\Support\Arr;

/**
 * Interface to define core system Roles
 */
class RoleInterface
{
    // Define the core roles
    const ADMIN = 'admin';
    const SUPER = 'super';

    const ALL_ROLES = [
        self::ADMIN,
        self::SUPER,
    ];

    const ALL_ROLES_LABELLED = [
        self::ADMIN => 'Admin',
        self::SUPER => 'Super',
    ];


    // Define the roles that a user with the current role is able to select / assign.
    const ADMIN_SELECTABLE_ROLES = [
        self::ADMIN,
    ];

    const SUPER_SELECTABLE_ROLES = [
        self::ADMIN,
        self::SUPER,
    ];


    /**
     * Get the roles that the current role is allowed select and assign to others.
     * @param string|null $current_role
     * @param bool $labelled
     * @return array
     */
    public static function getSelectableRoles(?string $current_role = null, bool $labelled = false) : array
    {
        $roles = [
            self::ADMIN => self::ADMIN_SELECTABLE_ROLES,
            self::SUPER => self::SUPER_SELECTABLE_ROLES,
        ];

        $selectable_roles = Arr::get($roles, $current_role, []);

        if (!$labelled) {
            return $selectable_roles;
        }

        $labelled_roles = [];
        foreach ($selectable_roles as $role) {
            $labelled_roles[$role] = Arr::get(self::ALL_ROLES_LABELLED, $role, 'UNKNOWN ROLE');
        }

        return $labelled_roles;
    }
}
