<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricalPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'part_number',
        'brand',
        'quantity',
        'unit'
    ];
    
    public function riwayatMasuk()
{
    return $this->hasMany(RiwayatBarangMasuk::class, 'electrical_part_id');
}

public function riwayatKeluar()
{
    return $this->hasMany(RiwayatBarangKeluar::class, 'electrical_part_id');
}

}
