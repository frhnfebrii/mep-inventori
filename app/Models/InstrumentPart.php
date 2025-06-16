<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentPart extends Model
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
        return $this->hasMany(RiwayatBarangMasuk::class, 'instrument_part_id');
    }

    public function riwayatKeluar()
    {
        return $this->hasMany(RiwayatBarangKeluar::class, 'instrument_part_id');
    }
}
