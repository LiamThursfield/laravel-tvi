<?php

namespace Database\Factories\EDU\Course;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'How to become a ' . $this->faker->jobTitle();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => $this->faker->text(),
            'description' => $this->faker->realText(),
            'creator_id' => 1,
            'status' => $this->faker->randomElement(array_keys(CourseInterface::STATUSES)),
            'available_from' => now(),
            'available_to' => null,

            'content_length_video' => $this->faker->randomDigitNotZero(),
            'banner' => 'https://images.unsplash.com/photo-1590845947670-c009801ffa74?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2059&q=80',
            'primary_image' => 'https://images.unsplash.com/photo-1695649920693-58e7aec67ae2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1964&q=80',
            'video_preview' => 'https://player.vimeo.com/video/439035104?h=8a93ad7e59',

            'price' => $this->faker->numberBetween(50, 200) * 100,
            'discount_price' => null,
            'currency' => CoursePurchaseInterface::CURRENCY_GB,

            'has_webinars' => $this->faker->boolean(),

            'languages' => $this->faker->boolean(),
            'has_money_back_guarantee' => $this->faker->boolean(),
            'has_captions' => $this->faker->boolean(),
            'has_lifetime_access' => $this->faker->boolean(),
            'has_student_discount' => $this->faker->boolean(),
            'has_pdfs' => $this->faker->boolean(),
            'has_free_seo_exposure' => $this->faker->boolean(),
        ];
    }
}
