<?php

namespace Database\Factories\EDU\Purchase;

use App\Interfaces\EDU\Purchase\PurchaseInterface;
use App\Models\EDU\Purchase\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attach_user = $this->faker->boolean();

        return [
            'payment_status' => $this->faker->shuffleArray(array_keys(PurchaseInterface::PAYMENT_STATUSES))[0],
            'email_address' => $this->faker->email(),
            'user_id' => $attach_user ? User::factory() : null,
            'redeemed_at' => $attach_user ? $this->faker->date() : null,
            'payment_currency' => $this->faker->shuffleArray(array_keys(PurchaseInterface::CURRENCIES))[0],
            'payment_total' => $this->faker->randomFloat(2, 15, 45),
            'payment_gateway' => $this->faker->shuffleArray(array_keys(PurchaseInterface::PAYMENT_GATEWAYS))[0],
            'payment_gateway_response_id' => $this->faker->bothify("#####???###???"),
            'is_refundable' => $this->faker->boolean(85),
        ];
    }
}
