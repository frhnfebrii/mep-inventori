<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatBarangKeluar extends Model
{
    protected $fillable = [
        'electrical_part_id',
        'tools_part_id',
        'instrument_part_id',
        'quantity',
        'unit',
        'tanggal',
    ];

    // Relasi ke ElectricalPart
    public function electricalPart()
    {
        return $this->belongsTo(ElectricalPart::class);
    }

    // Relasi ke ToolsPart
    public function toolsPart()
    {
        return $this->belongsTo(ToolsPart::class);
    }

    // Relasi ke InstrumentPart
    public function instrumentPart()
    {
        return $this->belongsTo(InstrumentPart::class);
    }

    // Akses part yang aktif (yang sedang diisi)
    public function getPartAttribute()
    {
        return $this->electricalPart ?? $this->toolsPart ?? $this->instrumentPart;
    }

    // Akses jenis part yang dipakai
    public function getJenisPartAttribute()
    {
        if ($this->electrical_part_id) {
            return 'electrical';
        } elseif ($this->tools_part_id) {
            return 'tools';
        } elseif ($this->instrument_part_id) {
            return 'instrument';
        }

        return null;
    }
}

