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

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function negotiations(): HasMany
    {
        return $this->hasMany(Negotiation::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}