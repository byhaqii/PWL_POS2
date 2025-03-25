<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['user_id' => 3, 'sales_code' => 'SAL1', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL2', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL3', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL4', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL5', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL6', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL7', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL8', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL9', 'sales_buyer' => fake()->name()],
            ['user_id' => 3, 'sales_code' => 'SAL10', 'sales_buyer' => fake()->name()],
        ];

        foreach ($data as $value) {
            Sales::create($value);
        }
    }
}
