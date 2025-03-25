<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => '1', 'level_code' => 'ADM', 'level_name' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['level_id' => '2', 'level_code' => 'MNG', 'level_name' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
            ['level_id' => '3', 'level_code' => 'STF', 'level_name' => 'Staff/Kasir', 'created_at' => now(), 'updated_at' => now()],
        ];

        Level::insert($data);
    }
}
