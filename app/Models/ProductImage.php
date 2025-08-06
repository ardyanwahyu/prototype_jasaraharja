<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images'; // opsional, bisa dihapus kalau pakai konvensi

    protected $fillable = [
        'product_id',
        'image_path',
        'order',
    ];

    /**
     * Relasi ke produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
