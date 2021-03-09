<?php

namespace App\Http\Requests\Admin\CRM\Contact;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CRM\ContactInterface;
use Illuminate\Validation\Rule;

class ContactStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email'                 => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'marketing_email'       => 'nullable|boolean',
            'marketing_sms'         => 'nullable|boolean',
            'marketing_telephone'   => 'nullable|boolean',
            'telephone'             => 'nullable|string|max:' . ContactInterface::FIELD_TELEPHONE_MAX_LENGTH,
            'title'                 => 'nullable|string|max:255',
        ];
    }
}
