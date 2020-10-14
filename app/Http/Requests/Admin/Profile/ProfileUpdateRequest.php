<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public $status = 303;

    /**
     * Define the rules for the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id(), 'id'),
            ],
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

}
