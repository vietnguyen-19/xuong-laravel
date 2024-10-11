<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Middleware\FlagMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('totals', function () {

    $totals = DB::table('sales')
        ->select(
            DB::raw('SUM(total) as total_sale'),
            DB::raw('DATE_FORMAT(sale_date, "%Y-%m") as month_year')
        )
        ->groupBy('month_year')
        ->get();
    // dd($totals);
    return view('bt2.total', ['totals' => $totals]);
});


Route::get('expenses', function () {

    $expenses = DB::table('expenses')
        ->select(
            DB::raw('SUM(amount) as total_expenses'),
            DB::raw('DATE_FORMAT(expense_date, "%Y-%m") as month_year')
        )
        ->groupBy('month_year')
        ->get();

    return view('bt2.expense', ['expenses' => $expenses]);
});


Route::post('financial', [FinancialReportController::class, 'store'])->name('financial/store');

Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
