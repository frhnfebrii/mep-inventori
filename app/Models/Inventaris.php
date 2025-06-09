<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris'; // Nama tabel di database

    protected $fillable = [
        'nama_barang',
        'merk',
        'serial_number',
        'price',
        'lokasi',
        'quantity',
        'remark',
    ];
}
