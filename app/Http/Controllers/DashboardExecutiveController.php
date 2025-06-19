<?php

namespace App\Http\Controllers;

use App\Models\ElectricalPart;
use App\Models\InstrumentPart;
use App\Models\ToolsPart;
use App\Models\RiwayatBarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardExecutiveController extends Controller
{
    public function index()
    {
        // Data semua part
        $electrical = ElectricalPart::all();
        $instrument = InstrumentPart::all();
        $tools = ToolsPart::all();

        // Ambil data top keluar 30 hari terakhir
        $topElectrical = RiwayatBarangKeluar::with('electricalPart')
            ->whereNotNull('electrical_part_id')
            ->where('tanggal', '>=', Carbon::now()->subDays(30)) 
            ->selectRaw('electrical_part_id, SUM(quantity) as total')
            ->groupBy('electrical_part_id')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        $topInstrument = RiwayatBarangKeluar::with('instrumentPart')
            ->whereNotNull('instrument_part_id')
            ->where('tanggal', '>=', Carbon::now()->subDays(30)) 
            ->selectRaw('instrument_part_id, SUM(quantity) as total')
            ->groupBy('instrument_part_id')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        $topTools = RiwayatBarangKeluar::with('toolsPart')
            ->whereNotNull('tools_part_id')
            ->where('tanggal', '>=', Carbon::now()->subDays(30)) 
            ->selectRaw('tools_part_id, SUM(quantity) as total')
            ->groupBy('tools_part_id')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        return view('executive.dashboard', compact(
            'electrical',
            'instrument',
            'tools',
            'topElectrical',
            'topInstrument',
            'topTools'
        ));
    }
}