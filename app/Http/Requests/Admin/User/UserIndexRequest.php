<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseIndexRequest;

class UserIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'user_email'        => 'nullable|string',
            'user_first_name'   => 'nullable|string',
            'user_last_name'    => 'nullable|string',
        ]);
    }
}
