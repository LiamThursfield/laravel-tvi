<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;

class UserUpdateRequest extends BaseUserRequest
{
    public function rules() : array
    {
        return [
            'email'         => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id, 'id'),
            ],
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'roles'         => 'nullable|array'
        ];
    }
}
