<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceList>
 */
class PriceListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price'=> $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.0, $max = 100.00), 
            'isAvailable' =>$this->faker->boolean(), 
            'store_id' => function(){
                return Stores::factory()->create()->id;
            }, 
            'produt_id'=> function () {
                return Product::factory()->create()->id;
            },
        ];
    }
}
