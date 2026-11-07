<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * Relasi: Pesanan dimiliki oleh satu pembeli.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Relasi: Pesanan terkait dengan satu produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relasi: Satu pesanan dapat memiliki banyak ulasan.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'order_id');
    }
}
