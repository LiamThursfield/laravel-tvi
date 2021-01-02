<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

class BaseUserRequest extends BaseRequest
{
    public function validated()
    {
        $validated =  parent::validated();

        if (!isset($validated['roles']) || !count($validated['roles'])) {
            return $validated;
        }

        // Remove any roles that the current user is not allowed to select
        $selectable_roles = Auth::user()->getSelectableRoles(true);
        foreach ($validated['roles'] as $role => $is_selected) {
            if (!in_array($role, $selectable_roles)) {
                unset($validated['roles'][$role]);
            }
        }

        return $validated;
    }
}
