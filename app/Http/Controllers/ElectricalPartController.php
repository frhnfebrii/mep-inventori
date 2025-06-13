<?php

namespace App\Http\Controllers;

use App\Models\ElectricalPart;
use Illuminate\Http\Request;

class ElectricalPartController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $electricalParts = ElectricalPart::all();
        return view('electrical', compact('electricalParts'));
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

        ElectricalPart::create($request->all());

        return redirect()->route('electrical.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, ElectricalPart $electrical)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'quantity'    => 'required|integer',
            'unit'        => 'required|string',
        ]);

        $electrical->update($request->all());

        return redirect()->route('electrical.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(ElectricalPart $electrical)
    {
        $electrical->delete();

        return redirect()->route('electrical.index')->with('success', 'Data berhasil dihapus.');
    }
}
