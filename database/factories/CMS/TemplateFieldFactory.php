<?php

namespace Database\Factories\CMS;

use App\Interfaces\CMS\TemplateFieldInterface;
use App\Models\CMS\Template;
use App\Models\CMS\TemplateField;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TemplateFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TemplateField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'template_id' => Template::factory(),
            'type' => Arr::get(
                TemplateFieldInterface::ALL_TYPES,
                $this->faker->numberBetween(0, count(TemplateFieldInterface::ALL_TYPES) - 1)
            ),
            'name' => $this->faker->words(5, true),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'description' => $this->faker->paragraph,
            'is_required' => $this->faker->boolean,
            'order' => $this->faker->numberBetween(0, 100),
            'settings' => null, // TODO: Look into setting default settings per type
            'deleted_at' => $this->faker->boolean ? Carbon::now() : null,
        ];
    }
}
