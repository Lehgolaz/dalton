<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Budget;
use App\Models\BudgetType;
use App\Models\PriceList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'number' => $this->faker->randomNumber(),
           'budget_date' => $this->faker->dateTimeBetween('2023-01-01', '2023-0-01')->format('y-m-d'),
           'experation_date' => $this->faker->dateTimeBetween('2023-07-01', '2023-09-01')->format('y-m-d'),
           'delivery_date' => $this->faker->dateTimeBetween('2023-09-01', '2023-12-31')->format('y-m-d'),
           "shipping_vallue" => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.0, $max = 100.00),
           'address_id'=> function(){
               Address::factory()->create()->id;
           },
           'budget_type_id'=> function(){
               BudgetType::factory()->create()->id;
           },
        ];
    }
}
