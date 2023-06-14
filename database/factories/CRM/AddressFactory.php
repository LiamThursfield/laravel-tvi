<?php

namespace Database\Factories\CRM;

use App\Interfaces\CMS\TemplateInterface;
use App\Models\CRM\Address;
use App\Models\CRM\Contact;
use App\Models\CRM\OrganisationUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Scalar\String_;

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
        $addressableType = $this->faker->shuffleArray(
            [
                'organisation_unit',
                'contact',
            ]
        )[0];

        return [
            'postcode' => $this->faker->postcode,
            'line_1' => $this->faker->streetAddress,
            'line_2' => $this->faker->secondaryAddress,
            'line_3' => $this->faker->secondaryAddress,
            'town_city' => $this->faker->city,
            'county' => $this->faker->state,
            'country' => $this->faker->country,
            'addressable_id' => $this->getAddressableFactory($addressableType),
            'addressable_type' => $this->getAddressableClass($addressableType),
        ];
    }

    protected function getAddressableFactory(string $addressableType): ?Factory
    {
        return match ($addressableType) {
            'organisation_unit' => OrganisationUnit::factory(),
            'contact' => Contact::factory(),
            default => null,
        };
    }

    protected function getAddressableClass(string $addressableType): ?string
    {
        return match ($addressableType) {
            'organisation_unit' => OrganisationUnit::class,
            'contact' => Contact::class,
            default => null,
        };
    }
}
