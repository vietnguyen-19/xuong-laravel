<?php

use App\Models\Product;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // khóa chính

            $table->foreignIdFor(Product::class)->constrained(); // khóa ngoại tham chiếu products(id)
            $table->integer('quantity'); //số lượng sản phẩm bán ra
            $table->decimal('price', 10, 2); //giá bán đơn vị của sản phẩm
            $table->decimal('tax', 10, 2); // thuế VAT (nếu có)
            $table->decimal('total', 10, 2); // tổng giá trị giao dịch (quantity * price + tax)
            $table->date('sale_date'); // ngày thực hiện giao dịch


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
