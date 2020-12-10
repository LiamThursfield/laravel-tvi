<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;

class UserStoreRequest extends BaseUserRequest
{
    public function rules() : array
    {
        return [
            'email'         => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
            'roles'         => 'nullable|array'
        ];
    }
}
