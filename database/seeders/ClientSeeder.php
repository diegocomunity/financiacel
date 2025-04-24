<?php

namespace Database\Seeders;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'credit_score' => 720,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'María Gómez',
                'email' => 'maria@example.com',
                'credit_score' => 650,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Luis Rodríguez',
                'email' => 'luis@example.com',
                'credit_score' => 580,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
