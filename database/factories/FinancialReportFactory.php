<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\Sale;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialReport>
 */
class FinancialReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // Tính tổng doanh thu
        $totalSales = DB::table('sales')->sum('total');
        // Sale::sum('total');

        // Tính tổng chi phí
        $totalExpenses = DB::table('expenses')->sum('amount');
        // Expense::sum('amount');

        // Tính lợi nhuận trước thuế
        $profitBeforeTax = $totalSales - $totalExpenses;

        // Lấy thuế suất VAT
        $taxRate = DB::table('taxes')->where('tax_name', 'VAT')->value('rate');
        //Tax::where('tax_name', 'VAT')->value('rate');

        // Tính thuế VAT
        $taxAmount = ($profitBeforeTax * $taxRate) / 100;

        // Tính lợi nhuận sau thuế
        $profitAfterTax = $profitBeforeTax - $taxAmount;


        return [
            'month' => 9,
            'year' => 2024,
            'total_sales' => $totalSales,
            'total_expenses' => $totalExpenses,
            'profit_before_tax' => $profitBeforeTax,
            'tax_amount' => $taxAmount,
            'profit_after_tax' => $profitAfterTax,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
