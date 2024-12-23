<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'category_id',
        'harga',
        'jumlah',
        'gambar',
    ];

    // Relasi ke Category
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id', 'id');
}

}