<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolsPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'quantity',
        'unit',
        'unit_price',
        'price',
        'remark',
    ];

    public function riwayatMasuk()
    {
        return $this->hasMany(RiwayatBarangMasuk::class, 'tools_part_id');
    }
    public function riwayatKeluar()
    {
        return $this->hasMany(RiwayatBarangKeluar::class, 'tools_part_id');
    }
}
