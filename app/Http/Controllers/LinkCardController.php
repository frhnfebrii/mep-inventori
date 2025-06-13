<?php

namespace App\Http\Controllers;

use App\Models\ElectricalPart;
use App\Models\InstrumentPart;
use App\Models\ToolsPart;
use App\Models\RiwayatBarangMasuk;
use App\Models\RiwayatBarangKeluar;
use Illuminate\Http\Request;

class LinkCardController extends Controller
{
    public function index()
    {
        $electricalCount = ElectricalPart::count();
        $instrumentCount = InstrumentPart::count();
        $toolsCount = ToolsPart::count();
        $barangmasukCount = RiwayatBarangMasuk::count();
        $barangkeluarCount = RiwayatBarangKeluar::count();

        return view('dashboard', compact('electricalCount', 'instrumentCount', 'toolsCount', 'barangmasukCount', 'barangkeluarCount'));
    }
}
