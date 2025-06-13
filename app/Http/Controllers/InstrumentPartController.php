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
            'quantity'    => 'required|integer',
            'unit'        => 'required|string',
        ]);

        InstrumentPart::create($request->all());

        return redirect()->route('instrument.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, InstrumentPart $instrument)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'quantity'    => 'required|integer',
            'unit'        => 'required|string',
        ]);

        $instrument->update($request->all());

        return redirect()->route('instrument.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(InstrumentPart $instrument)
    {
        $instrument->delete();

        return redirect()->route('instrument.index')->with('success', 'Data berhasil dihapus.');
    }
}
