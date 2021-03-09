<?php

namespace Database\Seeders;

use App\Interfaces\CRM\FormFieldInterface;
use App\Models\CRM\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createGeneralEnquiryForm();
    }


    protected function createGeneralEnquiryForm()
    {

        $form = Form::create([
            'name'              => 'General Enquiry',
            'slug'              => 'general-enquiry',
            'email_recipients'  => [
                'admin@example.com',
                'super@example.com',
            ]
        ]);

        $form->formFields()->createMany([
            [
                'is_required'   => true,
                'name'          => 'First Name',
                'order'         => 0,
                'slug'          => FormFieldInterface::TYPE_CRM_FIRST_NAME,
                'type'          => FormFieldInterface::TYPE_CRM_FIRST_NAME,
            ],
            [
                'is_required'   => false,
                'name'          => 'Last Name',
                'order'         => 1,
                'slug'          => FormFieldInterface::TYPE_CRM_LAST_NAME,
                'type'          => FormFieldInterface::TYPE_CRM_LAST_NAME,
            ],
            [
                'is_required'   => true,
                'name'          => 'Email',
                'order'         => 2,
                'slug'          => FormFieldInterface::TYPE_CRM_EMAIL,
                'type'          => FormFieldInterface::TYPE_CRM_EMAIL,
            ],
            [
                'is_required'   => false,
                'name'          => 'Enquiry',
                'order'         => 3,
                'settings'      => [
                    'max_length'    => 250,
                    'rows'          => 5,
                ],
                'slug'          => 'enquiry',
                'type'          => FormFieldInterface::TYPE_TEXTAREA,
            ],
        ]);
    }
}
