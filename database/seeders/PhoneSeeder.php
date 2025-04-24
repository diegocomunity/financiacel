<?php

namespace Database\Seeders;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phone::insert([
            [
                'model' => 'iPhone 13',
                'price' => 3500000,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Samsung Galaxy S22',
                'price' => 3000000,
                'stock' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Xiaomi Redmi Note 12',
                'price' => 1200000,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
