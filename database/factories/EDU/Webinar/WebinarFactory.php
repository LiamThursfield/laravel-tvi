<?php

namespace Database\Factories\EDU\Webinar;

use App\Models\EDU\Webinar\Webinar;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WebinarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Webinar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => $this->faker->realText(),
            'description' => $this->faker->realText(),
            'creator_id' => 1,
            'course_id' => 1,
            'section_id' => 1,
            'date_time_from' =>  $this->faker->dateTime,
            'date_time_to' =>  $this->faker->dateTime->add(DateInterval::createFromDateString('1 hour')),
            'webinar_url' =>  $this->faker->url,
            'can_users_reserve' =>  $this->faker->boolean,
            'is_recorded' =>  $this->faker->boolean,
        ];
    }
}
