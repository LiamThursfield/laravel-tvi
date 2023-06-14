<?php

namespace Tests\Feature\Admin\CRM;

use App\Models\CRM\Address;
use App\Models\CRM\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Admin\AbstractAdminTestCase;

class AddressTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function addresses_can_belong_to_a_contact()
    {
        $contact = Contact::factory()->create();

        $address = Address::factory()->create([
            'addressable_id' => $contact->id,
            'addressable_type' => Contact::class,
        ]);

        $this->assertEquals($contact->name, $address->addressable->name);
    }


    /** @test */
    public function customers_can_have_addresses()
    {
        $contact = Contact::factory()->create();

        $addresses = Address::factory(5)->create([
            'addressable_id' => $contact->id,
            'addressable_type' => Contact::class,
        ]);

        self::assertEquals(
            $contact->addresses->pluck('id'),
            $addresses->pluck('id')
        );
    }

}
