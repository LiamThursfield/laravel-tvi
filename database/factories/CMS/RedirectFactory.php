<?php

namespace Database\Factories\CMS;

use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Redirect;
use App\Models\CMS\Template;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RedirectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Redirect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url_from' => $this->faker->unique()->url(),
            'url_to' => $this->faker->url(),
            'is_enabled' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTime(),
            'expired_at' => $this->faker->boolean() ?
                null :
                $this->faker->dateTimeBetween(now()->clone()->subWeek(), now()->clone()->addWeek())
        ];
    }
}
