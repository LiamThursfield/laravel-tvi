<?php

namespace Database\Factories\EDU\Course;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CourseInstalmentPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseInstalmentPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseInstalmentPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course = Course::factory()->create();
        $price = $course->discount_price ? $course->discount_price : $course->price;

        $instalment_count = $this->faker->numberBetween(6, 24);

        // Increase price by 50% then calculate the instalment price rounded to an int
        $instalment_price = ($price * 1.5) / (int) $instalment_count;

        return [
            'course_id' =>$course->id,
            'instalment_count' => $instalment_count,
            'instalment_price' => $instalment_price,
            'instalment_discount_price' => null,
            'currency' => $course->currency,
        ];
    }
}
