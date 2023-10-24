<?php

namespace Database\Factories\EDU\Purchase;

use App\Models\EDU\Course\Course;
use App\Models\EDU\Purchase\Purchase;
use App\Models\EDU\Purchase\PurchaseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $quantity = 1;
        $price = $this->faker->randomFloat(2, 10, 20);

        return [
            'purchase_id' => Purchase::factory(),

            // TODO: Move to other types once available
            'purchasable_id' => Course::factory([
                'price' => $price
            ]),
            'purchasable_type' => Course::class,

            'quantity' => $quantity,
            'item_price' => $price,
            'total_price' => $price * $quantity
        ];
    }
}
