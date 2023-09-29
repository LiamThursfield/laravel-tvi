<?php

namespace Database\Factories\EDU\Announcement;

use App\Models\EDU\Announcement\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text();

        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'creator_id' => 1,
            'platform' => $this->faker->boolean,
            'email' =>  $this->faker->boolean,
            'sms' =>  $this->faker->boolean,
        ];
    }
}
