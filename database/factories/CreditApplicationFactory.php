<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditApplication>
 */
class CreditApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'phone_id' => \App\Models\Phone::factory(),
            'amount' => 1000000,
            'term_months' => 12,
            'state' => 'pending'
 
        ];
    }
}
