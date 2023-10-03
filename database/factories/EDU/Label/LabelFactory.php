<?php

namespace Database\Factories\EDU\Label;

use App\Models\EDU\Label\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LabelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Label::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->jobTitle();

        return [
            'label' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
