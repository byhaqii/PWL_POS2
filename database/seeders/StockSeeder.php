<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           ['item_id' => 1, 'user_id' => 3, 'stock_qty' => 10],
           ['item_id' => 2, 'user_id' => 3, 'stock_qty' => 5],
           ['item_id' => 3, 'user_id' => 3, 'stock_qty' => 20],
           ['item_id' => 4, 'user_id' => 3, 'stock_qty' => 15],
           ['item_id' => 5, 'user_id' => 3, 'stock_qty' => 30],
           ['item_id' => 6, 'user_id' => 3, 'stock_qty' => 20],
           ['item_id' => 7, 'user_id' => 3, 'stock_qty' => 10],
           ['item_id' => 8, 'user_id' => 3, 'stock_qty' => 10],
           ['item_id' => 9, 'user_id' => 3, 'stock_qty' => 10],
           ['item_id' => 10, 'user_id' => 3, 'stock_qty' => 5],
        ];

        foreach ($data as $value) {
            Stock::create($value);
        }
    }
}
