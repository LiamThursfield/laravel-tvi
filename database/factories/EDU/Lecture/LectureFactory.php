<?php

namespace Database\Factories\EDU\Lecture;

use App\Models\EDU\Lecture\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'Lecture ' . $this->faker->jobTitle();

        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'can_be_previewed' => $this->faker->boolean(),
            'preview_url' =>  $this->faker->url(),
            'video_url' =>  $this->faker->url(),
            'content_length' =>  $this->faker->randomDigitNotZero(),
            'index' =>  $this->faker->randomDigit(),
            'item_type' => 'lecture',
            'section_id' =>  1,
        ];
    }
}
