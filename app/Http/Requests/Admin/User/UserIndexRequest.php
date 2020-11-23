<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public int $status = 303;

    /**
     * Define the rules for the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_by'          => 'nullable|string',
            'order_direction'   => 'nullable|string',
            'per_page'          => 'nullable|integer',
            'user_email'        => 'nullable|string',
            'user_first_name'   => 'nullable|string',
            'user_last_name'    => 'nullable|string',
        ];
    }
}
