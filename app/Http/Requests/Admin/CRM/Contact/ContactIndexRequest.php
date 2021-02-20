<?php

namespace App\Http\Requests\Admin\CRM\Contact;

use App\Http\Requests\BaseIndexRequest;

class ContactIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'contact_email'        => 'nullable|string',
            'contact_first_name'   => 'nullable|string',
            'contact_last_name'    => 'nullable|string',
            'contact_telephone'    => 'nullable|string',
        ]);
    }
}
