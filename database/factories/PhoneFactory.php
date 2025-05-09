<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->word,  // Un modelo aleatorio
            'price' => $this->faker->numberBetween(100000, 5000000),  // Un precio aleatorio
            'stock' => $this->faker->randomNumber(),  
        ];
    }
}
