<?php

namespace App\Http\Controllers;

use App\Models\InstrumentPart;
use Illuminate\Http\Request;

class InstrumentPartController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $instrumentParts = InstrumentPart::all();
        return view('instrument', compact('instrumentParts'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'unit'        => 'required|string',
        ]);

        InstrumentPart::create([
            'description' => $request->description,
            'part_number' => $request->part_number,
            'brand'       => $request->brand,
            'unit'        => $request->unit,
            'quantity'    => 0, // Quantity fix 0 saat create
        ]);

        return redirect()->route('instrument.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, InstrumentPart $instrument)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string', 
            'unit'        => 'required|string',
        ]);

        $instrument->update([
            'description' => $request->description,
            'part_number' => $request->part_number,
            'brand'       => $request->brand,
            'unit'        => $request->unit,
            // Quantity tidak diupdate di sini, karena diatur dari transaksi
        ]);

        return redirect()->route('instrument.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(InstrumentPart $instrument)
    {
        $instrument->delete();

        return redirect()->route('instrument.index')->with('success', 'Data berhasil dihapus.');
    }
}
