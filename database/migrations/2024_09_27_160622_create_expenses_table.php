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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id(); // khóa chính

            $table->string('description'); // mô tả chi phí (nhập hàng, vận chuyển,...)
            $table->decimal('amount', 10, 2); //số tiền chi phí
            $table->date('expense_date'); // ngày phát sinh chi phí

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
