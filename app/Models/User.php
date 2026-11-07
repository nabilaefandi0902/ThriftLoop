<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Relasi: Satu user dapat memiliki banyak produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    /**
     * Relasi: Satu user dapat memiliki banyak penawaran.
     */
    public function negotiations(): HasMany
    {
        return $this->hasMany(Negotiation::class, 'buyer_id');
    }

    /**
     * Relasi: Satu user dapat memiliki banyak pesanan.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    /**
     * Relasi: Satu admin dapat memiliki banyak catatan verifikasi.
     */
    public function verificationLogs(): HasMany
    {
        return $this->hasMany(VerificationLog::class, 'admin_id');
    }

    /**
     * Relasi: Satu user dapat memberikan banyak ulasan.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isSeller(): bool
{
    return $this->role === 'seller';
}
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
