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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        $table->decimal('final_price', 12, 2);
        $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
        $table->enum('shipping_status', ['processing', 'shipped', 'delivered', 'completed'])->default('processing');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
