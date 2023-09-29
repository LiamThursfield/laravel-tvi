<?php

namespace Database\Factories\EDU\Section;

use App\Models\EDU\Section\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

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
            'lecture_count' => $this->faker->randomNumber(),
            'content_length' => $this->faker->randomNumber(),
            'index' => $this->faker->randomDigit(),
            'course_id' => 1,
        ];
    }
}
