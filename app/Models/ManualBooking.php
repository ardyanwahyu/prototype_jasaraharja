<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManualBooking extends Model
{
     protected $fillable = [
        'product_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
        'nama_manual',        // ✅ tambahan kamu
        'telepon_manual',
       
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Filter berdasarkan tanggal dan produk tertentu (optional)
     */
    public function scopeForProductOnDate($query, $productId, $date)
    {
        return $query->where('product_id', $productId)
                     ->where('tanggal_booking', $date);
    }

    /**
     * Cek apakah tanggal tertentu sudah diblokir (optional)
     */
    public static function isDateBlocked($productId, $date)
    {
        return self::where('product_id', $productId)
                   ->where('tanggal_booking', $date)
                   ->exists();
    }

    public function scopeAktif($query)
    {
        return $query->whereDate('tanggal_selesai', '>=', Carbon::today());
    }

    public function scopeRiwayat($query)
    {
        return $query->whereDate('tanggal_selesai', '<', Carbon::today());
    }

    public function getGuestNameAttribute()
    {
        return $this->user ? $this->user->name : $this->nama_manual;
    }

    public function getGuestPhoneAttribute()
    {
        return $this->user ? ($this->user->phone ?? '') : $this->telepon_manual;
    }


}
