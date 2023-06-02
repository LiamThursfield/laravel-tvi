<?php

namespace Database\Factories\CRM;

use App\Interfaces\CMS\TemplateInterface;
use App\Models\CRM\Address;
use App\Models\CRM\Contact;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postcode' => $this->faker->postcode,
            'line_1' => $this->faker->streetAddress,
            'line_2' => $this->faker->secondaryAddress,
            'line_3' => $this->faker->secondaryAddress,
            'town_city' => $this->faker->city,
            'county' => $this->faker->state,
            'country' => $this->faker->country,
            'contact_id' => Contact::factory(),
        ];
    }
}
