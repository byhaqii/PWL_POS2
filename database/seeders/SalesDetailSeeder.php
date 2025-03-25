<?php

namespace Database\Seeders;

use App\Models\SalesDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Sales 1
            ['sales_id' => 1, 'item_id' => 1, 'detail_qty' => 2, 'detail_price' => 150000],
            ['sales_id' => 1, 'item_id' => 2, 'detail_qty' => 1, 'detail_price' => 200000],
            ['sales_id' => 1, 'item_id' => 3, 'detail_qty' => 3, 'detail_price' => 250000],
            
            // Sales 2
            ['sales_id' => 2, 'item_id' => 2, 'detail_qty' => 1, 'detail_price' => 200000],
            ['sales_id' => 2, 'item_id' => 4, 'detail_qty' => 2, 'detail_price' => 180000],
            ['sales_id' => 2, 'item_id' => 5, 'detail_qty' => 1, 'detail_price' => 120000],
            
            // Sales 3
            ['sales_id' => 3, 'item_id' => 1, 'detail_qty' => 1, 'detail_price' => 150000],
            ['sales_id' => 3, 'item_id' => 3, 'detail_qty' => 2, 'detail_price' => 250000],
            ['sales_id' => 3, 'item_id' => 5, 'detail_qty' => 1, 'detail_price' => 120000],
            
            // Sales 4
            ['sales_id' => 4, 'item_id' => 2, 'detail_qty' => 3, 'detail_price' => 200000],
            ['sales_id' => 4, 'item_id' => 4, 'detail_qty' => 2, 'detail_price' => 180000],
            ['sales_id' => 4, 'item_id' => 1, 'detail_qty' => 1, 'detail_price' => 150000],
            
            // Sales 5
            ['sales_id' => 5, 'item_id' => 3, 'detail_qty' => 2, 'detail_price' => 250000],
            ['sales_id' => 5, 'item_id' => 5, 'detail_qty' => 3, 'detail_price' => 120000],
            ['sales_id' => 5, 'item_id' => 1, 'detail_qty' => 1, 'detail_price' => 150000],
            
            // Sales 6
            ['sales_id' => 6, 'item_id' => 4, 'detail_qty' => 1, 'detail_price' => 180000],
            ['sales_id' => 6, 'item_id' => 2, 'detail_qty' => 2, 'detail_price' => 200000],
            ['sales_id' => 6, 'item_id' => 3, 'detail_qty' => 1, 'detail_price' => 250000],
            
            // Sales 7
            ['sales_id' => 7, 'item_id' => 5, 'detail_qty' => 1, 'detail_price' => 120000],
            ['sales_id' => 7, 'item_id' => 1, 'detail_qty' => 2, 'detail_price' => 150000],
            ['sales_id' => 7, 'item_id' => 4, 'detail_qty' => 3, 'detail_price' => 180000],
            
            // Sales 8
            ['sales_id' => 8, 'item_id' => 2, 'detail_qty' => 2, 'detail_price' => 200000],
            ['sales_id' => 8, 'item_id' => 3, 'detail_qty' => 1, 'detail_price' => 250000],
            ['sales_id' => 8, 'item_id' => 5, 'detail_qty' => 3, 'detail_price' => 120000],
            
            // Sales 9
            ['sales_id' => 9, 'item_id' => 4, 'detail_qty' => 1, 'detail_price' => 180000],
            ['sales_id' => 9, 'item_id' => 2, 'detail_qty' => 2, 'detail_price' => 200000],
            ['sales_id' => 9, 'item_id' => 1, 'detail_qty' => 3, 'detail_price' => 150000],
            
            // Sales 10
            ['sales_id' => 10, 'item_id' => 3, 'detail_qty' => 2, 'detail_price' => 250000],
            ['sales_id' => 10, 'item_id' => 5, 'detail_qty' => 1, 'detail_price' => 120000],
            ['sales_id' => 10, 'item_id' => 4, 'detail_qty' => 2, 'detail_price' => 180000],
        ];

        foreach ($data as $value) {
            SalesDetail::create($value);
        }
    }
}
