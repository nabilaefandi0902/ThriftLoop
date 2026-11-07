<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'base_price',
        'min_price',
        'condition_percentage',
        'size_detail',
    ];

    /**
     * Relasi: Produk dimiliki oleh satu penjual.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Relasi: Satu produk dapat memiliki banyak penawaran.
     */
    public function negotiations(): HasMany
    {
        return $this->hasMany(Negotiation::class, 'product_id');
    }

    /**
     * Relasi: Satu produk dapat memiliki banyak pesanan.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    /**
     * Relasi: Satu produk dapat memiliki banyak catatan verifikasi.
     */
    public function verificationLogs(): HasMany
    {
        return $this->hasMany(VerificationLog::class, 'product_id');
    }
}
