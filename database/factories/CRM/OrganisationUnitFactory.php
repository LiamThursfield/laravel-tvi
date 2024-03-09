<?php

namespace Database\Factories\CRM;

use App\Interfaces\CRM\OrganisationUnitInterface;
use App\Models\CRM\OrganisationUnit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganisationUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrganisationUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $type = $this->faker->shuffleArray(OrganisationUnitInterface::TYPE_ENUM)[0];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => $type,
            'email' => $this->faker->email(),
            'telephone' => $this->faker->phoneNumber(),
            'notification_emails' => [
                $this->faker->email(),
                $this->faker->email(),
            ],
            'socials' => [
                'facebook' => $this->faker->userName(),
                'instagram' => $this->faker->userName(),
                'linkedin' => $this->faker->userName(),
                'snapchat' => $this->faker->userName(),
                'tiktok' => $this->faker->userName(),
                'twitter' => $this->faker->userName(),
            ],
            'company_id' => null, // Note this should be overridden at the factory create/make level for non-company types
            'location_id' => null, // Note this should be overridden at the factory create/make level for non-company/location types
        ];
    }
}
