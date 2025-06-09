<?php

namespace App\Http\Controllers;

use App\Models\barangmasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $barangmasuks = Barangmasuk::all();
        return view('electrical', compact('barangmasuks'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'quantity'    => 'required|integer',
        ]);

        Barangmasuk::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Barangmasuk $barangmasuk)
    {
        return view('barangmasuks.edit', compact('barangmasuk'));
    }

    // Update data
    public function update(Request $request, Barangmasuk $barangmasuk)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'quantity'    => 'required|integer',
        ]);

        $barangmasuk->update($request->all());

        return redirect()->route('barangmasuks.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(Barangmasuk $barangmasuk)
    {
        $barangmasuk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
