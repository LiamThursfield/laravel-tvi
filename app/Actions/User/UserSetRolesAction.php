<?php

namespace App\Actions\User;

use App\Models\User;

class UserSetRolesAction
{
    public function handle(User $user, array $user_roles_data) : User
    {
        if (count($user_roles_data) < 1) {
            return $user;
        }

        $current_roles = $user->roles->pluck('name');
        $checked_roles = [];
        $new_roles = [];

        // Add any enabled roles from the data
        foreach ($user_roles_data as $role => $is_enabled) {
            if ($is_enabled) {
                $new_roles[] = $role;
            }

            $checked_roles[] = $role;
        }

        // Add any roles that the user had and weren't set in the data
        foreach ($current_roles as $role) {
            if (!in_array($role, $checked_roles)) {
                $new_roles[] = $role;
            }
        }

        $user->syncRoles($new_roles);
        return $user;
    }
}
