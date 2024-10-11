<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert data cho trước vào bảng products trong database
        Product::insert([
            ['id' => 1, 'name' => 'Bàn gỗ', 'price' => 2000000, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Ghế xoay', 'price' => 1500000, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Tủ quần áo', 'price' => 5000000, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Giường ngủ', 'price' => 8000000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
