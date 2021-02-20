<?php

namespace App\Http\Requests\Admin\CRM\Contact;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CRM\ContactInterface;
use Illuminate\Validation\Rule;

class ContactUpdateRequest extends ContactStoreRequest
{
    public function rules() : array
    {
        $rules = parent::rules();

        $rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->ignore($this->contact->id, 'id'),
        ];

        return $rules;
    }
}
