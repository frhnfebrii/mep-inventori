<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrumentPart;
use App\Models\ToolsPart;
use App\Models\ElectricalPart;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap nilai dropdown 'month'
        $selectedMonth = $request->input('month', 'this_month');
        $selectedCategory = $request->input('category', 'all');

        // Hitung rentang tanggal sesuai pilihan
        if ($selectedMonth === 'last_month') {
            $startDate = Carbon::now()->subMonthNoOverflow()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->subMonthNoOverflow()->endOfMonth()->toDateString();
        } elseif (preg_match('/^\d{4}-\d{2}$/', $selectedMonth)) {
            // Format valid: 2025-05
            $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth()->toDateString();
            $endDate = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth()->toDateString();
        } else {
            // Default ke bulan ini
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Ambil semua data kategori

        $laporan = [];

        // Function untuk hitung stok
        $hitungLaporan = function ($item, $kategori) use ($startDate, $endDate) {
            // Barang masuk & keluar di bulan yang dipilih
            $masukBulanIni = $item->riwayatMasuk()
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->sum('quantity');
            $keluarBulanIni = $item->riwayatKeluar()
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->sum('quantity');

            // Total masuk & keluar sampai akhir bulan sebelumnya
            $masukSampaiLalu = $item->riwayatMasuk()
                ->where('tanggal', '<', $startDate)
                ->sum('quantity');
            $keluarSampaiLalu = $item->riwayatKeluar()
                ->where('tanggal', '<', $startDate)
                ->sum('quantity');

            // Stok awal = total masuk - keluar sampai akhir bulan lalu
            $stokAwal = $masukSampaiLalu - $keluarSampaiLalu;

            // Stok akhir = stok awal + masuk bulan ini - keluar bulan ini
            $stokAkhir = $stokAwal + $masukBulanIni - $keluarBulanIni;

            return [
                'kategori' => $kategori,
                'description' => $item->description,
                'part_number' => $item->part_number ?? '-',
                'brand' => $item->brand ?? '-',
                'stok_awal' => $stokAwal,
                'barang_masuk' => $masukBulanIni,
                'barang_keluar' => $keluarBulanIni,
                'stok_akhir' => $stokAkhir,
            ];
        };
        if ($selectedCategory === 'all' || $selectedCategory === 'Instrument') {
    foreach (InstrumentPart::all() as $item) {
        $laporan[] = $hitungLaporan($item, 'Instrument');
    }
    }

if ($selectedCategory === 'all' || $selectedCategory === 'Tools') {
    foreach (ToolsPart::all() as $item) {
        $laporan[] = $hitungLaporan($item, 'Tools');
    }
}

if ($selectedCategory === 'all' || $selectedCategory === 'Electrical') {
    foreach (ElectricalPart::all() as $item) {
        $laporan[] = $hitungLaporan($item, 'Electrical');
    }
}


        // Kirim ke blade
        return view('/admin/laporan', [
            'laporan' => $laporan,
            'selectedMonth' => $selectedMonth,
            'selectedCategory' => $selectedCategory,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    } // PASTIKAN ADA DI ATAS!

public function exportPdf(Request $request)
{
    // Reuse logika filter dari index
    $selectedMonth = $request->input('month', 'this_month');
    $selectedCategory = $request->input('category', 'all');

    if ($selectedMonth === 'last_month') {
        $startDate = Carbon::now()->subMonthNoOverflow()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->subMonthNoOverflow()->endOfMonth()->toDateString();
    } elseif (preg_match('/^\d{4}-\d{2}$/', $selectedMonth)) {
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth()->toDateString();
        $endDate = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth()->toDateString();
    } else {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    $laporan = [];

    $hitungLaporan = function ($item, $kategori) use ($startDate, $endDate) {
        $masukBulanIni = $item->riwayatMasuk()
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->sum('quantity');
        $keluarBulanIni = $item->riwayatKeluar()
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->sum('quantity');
        $masukSampaiLalu = $item->riwayatMasuk()
            ->where('tanggal', '<', $startDate)
            ->sum('quantity');
        $keluarSampaiLalu = $item->riwayatKeluar()
            ->where('tanggal', '<', $startDate)
            ->sum('quantity');

        $stokAwal = $masukSampaiLalu - $keluarSampaiLalu;
        $stokAkhir = $stokAwal + $masukBulanIni - $keluarBulanIni;

        return [
            'kategori' => $kategori,
            'description' => $item->description,
            'part_number' => $item->part_number ?? '-',
            'brand' => $item->brand ?? '-',
            'stok_awal' => $stokAwal,
            'barang_masuk' => $masukBulanIni,
            'barang_keluar' => $keluarBulanIni,
            'stok_akhir' => $stokAkhir,
        ];
    };

    if ($selectedCategory === 'all' || $selectedCategory === 'Instrument') {
        foreach (InstrumentPart::all() as $item) {
            $laporan[] = $hitungLaporan($item, 'Instrument');
        }
    }

    if ($selectedCategory === 'all' || $selectedCategory === 'Tools') {
        foreach (ToolsPart::all() as $item) {
            $laporan[] = $hitungLaporan($item, 'Tools');
        }
    }

    if ($selectedCategory === 'all' || $selectedCategory === 'Electrical') {
        foreach (ElectricalPart::all() as $item) {
            $laporan[] = $hitungLaporan($item, 'Electrical');
        }
    }

    $pdf = Pdf::loadView('admin.laporan_pdf', [
        'laporan' => $laporan,
        'selectedMonth' => $selectedMonth,
        'selectedCategory' => $selectedCategory,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);

    return $pdf->download('laporan_stok_barang.pdf');
}

}
