<?php

namespace Database\Factories\CRM;

use App\Interfaces\CMS\TemplateInterface;
use App\Interfaces\CRM\ContactInterface;
use App\Models\CRM\Address;
use App\Models\CRM\Contact;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title' => $this->faker->title,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'marketing_email' => $this->faker->boolean(),
            'marketing_sms' => $this->faker->boolean(),
            'marketing_telephone' => $this->faker->boolean(),
        ];
    }
}
