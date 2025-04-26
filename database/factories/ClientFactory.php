<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'credit_score' => $this->faker->numberBetween(300, 900), // o el rango que tú manejes
        ];
        

    }
}
