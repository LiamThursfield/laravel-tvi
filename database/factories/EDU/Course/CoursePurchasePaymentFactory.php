<?php

namespace Database\Factories\EDU\Course;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Models\EDU\Course\CoursePurchase;
use App\Models\EDU\Course\CoursePurchasePayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePurchasePaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePurchasePayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $purchase = CoursePurchase::factory()->create();

        $status = $this->faker->randomElement(CoursePurchaseInterface::PAYMENT_PAYMENT_STATUSES);
        $paid = match ($status) {
            CoursePurchaseInterface::PAYMENT_STATUS_PAID, CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED => true,
            default => false,
        };

        return [
            'course_purchase_id' => $purchase->id,
            'status' => $this->faker->randomElement(CoursePurchaseInterface::PAYMENT_PAYMENT_STATUSES),
            'price' => $this->faker->numberBetween(10, 100) * 100,
            'currency' => CoursePurchaseInterface::CURRENCY_GB,
            'due_date' => $paid ? $this->faker->dateTime() : $this->faker->dateTimeBetween('+1 day', '+300 days'),
            'paid_at' => $paid ? $this->faker->dateTime() : null,
            'payment_gateway_response_id' => $paid ? $this->faker->uuid() : null,
            'payment_gateway_response' => $paid ? ['some_key' => $this->faker->uuid()] : null
        ];
    }
}
