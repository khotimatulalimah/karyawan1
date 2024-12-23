<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'nama_barang',
        'tanggal',
        'harga',
        'jumlah',
        'subtotal',
        'metode_pembayaran',
    ];

    public function item()
{
    return $this->belongsTo(Sale::class, 'nama_barang', 'nama_barang');
}

}
