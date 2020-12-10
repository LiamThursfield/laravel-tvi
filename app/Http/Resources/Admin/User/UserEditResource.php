<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEditResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'email'         => $this->email,
            'first_name'    => $this->first_name,
            'id'            => $this->id,
            'last_name'     => $this->last_name,
            'name'          => $this->name ?? '',
        ];

        if ($this->whenLoaded('roles', true, false)) {
            $data['roles'] = $this->getRolesArray();
        }

        return $data;
    }

    protected function getRolesArray() : array
    {
        $roles = [];

        foreach ($this->roles as $role) {
            $roles[$role->name] = true;
        }

        return $roles;
    }
}
