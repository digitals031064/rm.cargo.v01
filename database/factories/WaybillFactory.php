<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Waybill>
 */
class WaybillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            'Smartphone', 'Laptop', 'Headphones', 'Bluetooth Speaker', 'Backpack',
            'Wristwatch', 'Sunglasses', 'Shoes', 'T-shirt', 'Jacket',
            'Tablet', 'Fitness Tracker', 'Power Bank', 'Camera', 'Phone Case',
            'Mouse', 'Keyboard', 'Books', 'Charger', 'Earbuds'
        ];
    
        return [
            'waybill_no' => strtoupper(Str::random(10)),
            'consignee_id' => $this->faker->numberBetween(1, 10),
            'shipper_id' => $this->faker->numberBetween(1, 10),
            'shipment' => $this->faker->randomElement($items),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'cbm' => $this->faker->randomFloat(1, 0.5, 10),
            'status' => $this->faker->randomElement([
                'Pending',
                'Arrived in Van Yard',
                'Arrived at Port of Origin',
                'Departed from Port of Origin',
                'Arrived at Port of Destination',
                'Delivered'
            ]),
        ];
    }
}
