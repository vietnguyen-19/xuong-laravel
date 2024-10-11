<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::insert([
            ['id' => 1, 'description' => 'Nhập hàng tháng 9', 'amount' => 5000000, 'expense_date' => '2024-09-05', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'description' => 'Chi phí vận chuyển', 'amount' => 1000000, 'expense_date' => '2024-09-10', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'description' => 'Bảo hành sản phẩm', 'amount' => 800000, 'expense_date' => '2024-09-12', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'description' => 'Lương nhân viên tháng 9', 'amount' => 12000000, 'expense_date' =>' 2024-09-30', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
