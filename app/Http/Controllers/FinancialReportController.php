<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialReportController extends Controller
{
    public function store(Request $request)
    {
        try {

            $month = $request->input('month', 9);
            $year = $request->input('year', 2024);

            $totalSalesForMonth = DB::table('sales')
                ->whereMonth('sale_date', $month)
                ->whereYear('sale_date', $year)
                ->sum('total');

            $totalExpensesForMonth = DB::table('expenses')
                ->whereMonth('expense_date', $month)
                ->whereYear('expense_date', $year)
                ->sum('amount');

            $taxRate = DB::table('taxes')
                ->where('tax_name', 'VAT')
                ->value('rate');

            $profitBeforeTax = $totalSalesForMonth - $totalExpensesForMonth;
            $taxAmount = $totalSalesForMonth * $taxRate;
            $profitAfterTax = $profitBeforeTax - $taxAmount;

            DB::table('financial_reports')->insert([
                'month' => $month,
                'year' => $year,
                'total_sales' => $totalSalesForMonth,
                'total_expenses' => $totalExpensesForMonth,
                'profit_before_tax' => $profitBeforeTax,
                'tax_amount' => $taxAmount,
                'profit_after_tax' => $profitAfterTax,
            ]);


            return back()->with('sucess', true); // nếu thêm thành công

        } catch (\Throwable $th) {

            return back()->with('sucess', false); // nếu thêm không thành công

        }
    }
}
