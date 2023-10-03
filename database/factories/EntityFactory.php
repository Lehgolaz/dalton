<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(), 
            'cpf_cnpj'=> $this->faker->unique()->numberfy('#############') , 
            'rg_ie'=> $this->faker->unique()->numberfy('#############'), 
            'imail'=> $this->faker->uniqeu()->email(), 
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
