<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstrumentPart;
use App\Models\ToolsPart;
use App\Models\ElectricalPart;
use App\Models\RiwayatBarangMasuk;
use App\Models\RiwayatBarangKeluar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanApiController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', 'this_month');
        $selectedCategory = $request->input('category', 'all');

        // Jika memilih semua bulan
        if ($selectedMonth === 'all') {
            return $this->getAllMonthsReport($selectedCategory);
        }

        // Hitung rentang tanggal untuk bulan tertentu
        $dateRange = $this->calculateDateRange($selectedMonth);
        $startDate = $dateRange['start_date'];
        $endDate = $dateRange['end_date'];

        $laporan = $this->generateMonthlyReport($selectedCategory, $startDate, $endDate);

        return response()->json([
            'success' => true,
            'data' => $laporan,
            'meta' => [
                'periode' => Carbon::parse($startDate)->format('F Y'),
                'selected_month' => $selectedMonth,
                'selected_category' => $selectedCategory,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_items' => count($laporan),
            ]
        ]);
    }

    protected function getAllMonthsReport($category)
    {
        // Dapatkan semua bulan yang memiliki transaksi
        $months = $this->getAvailableMonths();
        $fullReport = [];

        foreach ($months as $month) {
            $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
            $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

            $monthlyReport = $this->generateMonthlyReport(
                $category,
                $startDate->toDateString(),
                $endDate->toDateString()
            );

            $fullReport[] = [
                'periode' => $startDate->format('F Y'),
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'items' => $monthlyReport,
                'total_items' => count($monthlyReport)
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $fullReport,
            'meta' => [
                'total_periods' => count($months),
                'selected_category' => $category,
                'generated_at' => now()->toDateTimeString()
            ]
        ]);
    }

    protected function generateMonthlyReport($category, $startDate, $endDate)
    {
        $laporan = [];
        $no = 1;

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

        if ($category === 'all' || $category === 'Instrument') {
            foreach (InstrumentPart::all() as $item) {
                $laporan[] = $hitungLaporan($item, 'Instrument');
            }
        }

        if ($category === 'all' || $category === 'Tools') {
            foreach (ToolsPart::all() as $item) {
                $laporan[] = $hitungLaporan($item, 'Tools');
            }
        }

        if ($category === 'all' || $category === 'Electrical') {
            foreach (ElectricalPart::all() as $item) {
                $laporan[] = $hitungLaporan($item, 'Electrical');
            }
        }

        return $laporan;
    }

    protected function calculateDateRange($monthSelection)
    {
        if ($monthSelection === 'last_month') {
            return [
                'start_date' => Carbon::now()->subMonthNoOverflow()->startOfMonth()->toDateString(),
                'end_date' => Carbon::now()->subMonthNoOverflow()->endOfMonth()->toDateString()
            ];
        } elseif (preg_match('/^\d{4}-\d{2}$/', $monthSelection)) {
            return [
                'start_date' => Carbon::createFromFormat('Y-m', $monthSelection)->startOfMonth()->toDateString(),
                'end_date' => Carbon::createFromFormat('Y-m', $monthSelection)->endOfMonth()->toDateString()
            ];
        }

        return [
            'start_date' => Carbon::now()->startOfMonth()->toDateString(),
            'end_date' => Carbon::now()->endOfMonth()->toDateString()
        ];
    }

    protected function getAvailableMonths()
    {
        return RiwayatBarangMasuk::select(DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"))
            ->union(RiwayatBarangKeluar::select(DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan")))
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->pluck('bulan')
            ->toArray();
    }
}