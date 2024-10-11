<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id(); // khóa chính

            $table->tinyInteger('month'); //dùng tinyIntrger để lưu trữ giá trị từ 1-12

            $table->integer('year'); // năm
            $table->decimal('total_sales', 10, 2); //tổng doanh thu
            $table->decimal('total_expenses', 10, 2); // tổng chi phí
            $table->decimal('profit_before_tax', 10, 2); // lợi nhuận trước thuế
            $table->decimal('tax_amount',10,2); // thuế phải nộp
            $table->decimal('profit_after_tax', 10, 2); // lợi nhuận sau thuế


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
