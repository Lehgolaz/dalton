<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' =>$this->faker->randomNumber(), 
            'complement' => $this->faker->word(),
            'zipcode_id'=> function () {
                return ZipCode::factory()->create()->id;
            },
            'entity_id'=> function () {
                return Entity::factory()->create()->id;
            },
        ];
    }
}
