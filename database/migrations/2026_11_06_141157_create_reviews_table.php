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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
        $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade'); // Pembeli yang memberi ulasan
        $table->integer('rating'); // Skala 1 sampai 5
        $table->text('comment'); // Ulasan teks terkait kondisi barang
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
