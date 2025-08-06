<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    'slug',
    'description',
    'luas',
    'fasilitas',
    'harga',
    'keterangan',
    'harga_siang',
    'harga_malam',
    'status',
    'kategori',
    'lokasi_maps',
    'tanggal_disewa_terakhir',
    'tanggal_tersedia',
];


    
    
    // Relasi ke gambar
    public function images()
    {
         return $this->hasMany(\App\Models\Image::class);
    }

    public function manualBookings()
    {
        return $this->hasMany(\App\Models\ManualBooking::class);
    }
    
    


}
