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
      Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
        $table->string('title');
        $table->text('description');
        $table->decimal('base_price', 12, 2);
        $table->decimal('min_price', 12, 2); // Batas toleransi dynamic pricing
        $table->integer('condition_percentage'); // Persentase kondisi fisik (misal: 90)
        $table->string('size_detail'); // Detail ukuran (misal: LD 100cm)
        $table->enum('status', ['pending_curation', 'verified', 'rejected', 'sold'])->default('pending_curation');
        $table->timestamps();
    });  
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
