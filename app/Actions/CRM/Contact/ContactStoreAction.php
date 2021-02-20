<?php

namespace App\Actions\CRM\Contact;

use App\Models\CRM\Contact;

class ContactStoreAction
{
    public function handle(array $contact_data) : Contact
    {
        return Contact::create($contact_data);
    }
}
