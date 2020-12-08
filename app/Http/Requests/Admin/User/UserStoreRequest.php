<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
