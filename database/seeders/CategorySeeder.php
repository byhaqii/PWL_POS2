<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category_id' => 1, 'category_code' => 'SNK1', 'category_name' => 'Sneaker Pria'],
            ['category_id' => 2, 'category_code' => 'SNK2', 'category_name' => 'Sneaker Wanita'],
            ['category_id' => 3, 'category_code' => 'OR1', 'category_name' => 'Sepatu Olahraga'],
            ['category_id' => 4, 'category_code' => 'CAS1', 'category_name' => 'Casual'],
            ['category_id' => 5, 'category_code' => 'SND1', 'category_name' => 'Sandal Pria'],
        ];

        Category::insert($data);
    }
}
