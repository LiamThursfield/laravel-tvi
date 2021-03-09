<?php

namespace App\Actions\CRM\Contact;

use App\Models\CRM\Contact;

class ContactUpdateAction
{
    public function handle(Contact $contact, array $contact_data, bool $refresh = false) : Contact
    {
        $contact->update($contact_data);

        if ($refresh) {
            $contact->refresh();
        }

        return $contact;
    }
}
