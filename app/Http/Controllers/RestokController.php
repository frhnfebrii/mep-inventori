<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricalPart;
use App\Models\ToolsPart;
use App\Models\InstrumentPart;
use Carbon\Carbon;

class RestokController extends Controller
{
    public function index()
    {
        $result = [];

        // ✅ Electrical
        $electrical = $this->checkRestok(ElectricalPart::all(), 'Electrical');
        if (count($electrical) > 0) {
            $result['electrical'] = $electrical;
        }

        // ✅ Tools
        $tools = $this->checkRestok(ToolsPart::all(), 'Tools');
        if (count($tools) > 0) {
            $result['tools'] = $tools;
        }

        // ✅ Instrument
        $instrument = $this->checkRestok(InstrumentPart::all(), 'Instrument');
        if (count($instrument) > 0) {
            $result['instrument'] = $instrument;
        }

        // ✅ Daftar range untuk filter dropdown
        $categories = ['A1', 'A2', 'A3'];

        // ✅ Kirim ke Blade
        return view('/admin/restok', [
            'data' => $result,
            'categories' => $categories
        ]);
    }

    private function checkRestok($items, $kategoriBarang)
    {
        $data = [];
        foreach ($items as $item) {
            // Hitung rata-rata barang keluar tanpa batas bulan
            $avgOut = $item->riwayatKeluar()->avg('quantity') ?? 0;

            // Ambil stok sekarang
            $currentStock = $item->quantity ?? 0;

            // Klasifikasi range
            if ($currentStock >= ($avgOut * 1.4)) {
                $range = 'A1'; // Aman
            } elseif ($currentStock >= $avgOut) {
                $range = 'A2'; // Pertimbangkan Restok
            } else {
                $range = 'A3'; // Perlu Restok
            }

            // Rule IF-THEN: status sesuai range
            if ($range === 'A1') {
                $status = 'Aman';
            } elseif ($range === 'A2') {
                $status = 'Pertimbangkan Restok';
            } else {
                $status = 'Perlu Restok';
            }

            $data[] = [
                'id' => $item->id,
                'description' => $item->description,
                'part_number' => $item->part_number ?? '-',
                'avg_out' => round($avgOut, 2),
                'stok_saat_ini' => $currentStock,
                'kategori_barang' => $kategoriBarang, // ✅ nama kategori barang
                'range' => $range, // ✅ range (A1-A3)
                'status' => $status,
            ];
        }

        return $data;
    }
}
