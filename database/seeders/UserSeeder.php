<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => '1', 'username' => 'admin', 'name' => 'Administrator', 'password' => bcrypt('admin')],
            ['level_id' => '2', 'username' => 'manager', 'name' => 'Manager', 'password' => bcrypt('manager')],
            ['level_id' => '3', 'username' => 'staff', 'name' => 'Staff/Kasir', 'password' => bcrypt('staff')],
        ];

        foreach ($data as $value) {
            User::create($value);
        }
    }
}
