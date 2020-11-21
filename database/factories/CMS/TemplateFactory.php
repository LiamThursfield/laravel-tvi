<?php

namespace Database\Factories\CMS;

use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Template;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Template::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Arr::get(
                TemplateInterface::ALL_TYPES,
                $this->faker->numberBetween(0, count(TemplateInterface::ALL_TYPES) - 1)
            ),
            'name' => $this->faker->words(3, true),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'description' => $this->faker->paragraph,
            'deleted_at' => $this->faker->boolean() ? Carbon::now() : null,
        ];
    }
}
