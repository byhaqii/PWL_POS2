<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category_id' => 1, 'item_code' => 'SNK101', 'item_name' => 'Nike Air Max', 'item_buy_price' => 500000, 'item_sell_price' => 750000],
            ['category_id' => 1, 'item_code' => 'SNK102', 'item_name' => 'Adidas Ultraboost', 'item_buy_price' => 600000, 'item_sell_price' => 850000],
            ['category_id' => 2, 'item_code' => 'SNK201', 'item_name' => 'Puma RS-X', 'item_buy_price' => 550000, 'item_sell_price' => 800000],
            ['category_id' => 2, 'item_code' => 'SNK202', 'item_name' => 'Reebok Classic', 'item_buy_price' => 400000, 'item_sell_price' => 650000],
            ['category_id' => 3, 'item_code' => 'OR101', 'item_name' => 'Asics Gel Kayano', 'item_buy_price' => 700000, 'item_sell_price' => 1000000],
            ['category_id' => 3, 'item_code' => 'OR102', 'item_name' => 'Mizuno Wave Rider', 'item_buy_price' => 650000, 'item_sell_price' => 950000],
            ['category_id' => 4, 'item_code' => 'CAS101', 'item_name' => 'Vans Old Skool', 'item_buy_price' => 450000, 'item_sell_price' => 700000],
            ['category_id' => 4, 'item_code' => 'CAS102', 'item_name' => 'Converse Chuck Taylor', 'item_buy_price' => 400000, 'item_sell_price' => 600000],
            ['category_id' => 5, 'item_code' => 'SND101', 'item_name' => 'Eiger Sandal Outdoor', 'item_buy_price' => 300000, 'item_sell_price' => 500000],
            ['category_id' => 5, 'item_code' => 'SND102', 'item_name' => 'Skechers Sandal', 'item_buy_price' => 350000, 'item_sell_price' => 550000],
        ];

        foreach ($data as $value) {
            Item::create($value);
        }
    }
}
