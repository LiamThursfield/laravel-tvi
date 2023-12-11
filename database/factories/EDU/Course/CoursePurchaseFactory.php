<?php

namespace Database\Factories\EDU\Course;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CoursePurchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePurchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->numberBetween(50, 200) * 100;
        $currency = CoursePurchaseInterface::CURRENCY_GB;
        $status = $this->faker->randomElement(CoursePurchaseInterface::PURCHASE_PAYMENT_STATUSES);

        $price_paid = match ($status) {
            CoursePurchaseInterface::PAYMENT_STATUS_PAID, CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED => $price,
            CoursePurchaseInterface::PAYMENT_STATUS_PENDING => 0,
            default => $this->faker->numberBetween(50, $price),
        };

        return [
            'course_id' => Course::factory([
                'price' => $price,
                'discount_price' => null,
                'currency' => $currency,
            ]),
            'status' => null,
            'type' => CoursePurchaseInterface::PURCHASE_TYPE_FULL,
            'instalment_plan_id' => null,
            'email_address' => $this->faker->email,
            'user_id' => User::factory(),
            'redeemed_at' => null,
            'total_price_due' => $price,
            'currency' => $currency,
            'total_price_paid' => $price_paid,
            'full_price_paid_at' => ($price === $price_paid) ? $this->faker->dateTime() : null,
            'payment_gateway' => CoursePurchaseInterface::PAYMENT_GATEWAY_STRIPE
        ];
    }
}
