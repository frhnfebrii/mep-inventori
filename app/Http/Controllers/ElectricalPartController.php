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
        return view('/admin/electrical', compact('electricalParts'));
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

        ElectricalPart::create([
            'description' => $request->description,
            'part_number' => $request->part_number,
            'brand'       => $request->brand,
            'unit'        => $request->unit,
            'quantity'    => 0, // Quantity fix 0 saat create
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, ElectricalPart $electrical)
    {
        $request->validate([
            'description' => 'required|string',
            'part_number' => 'required|string',
            'brand'       => 'required|string',
            'unit'        => 'required|string',
        ]);

        $electrical->update([
            'description' => $request->description,
            'part_number' => $request->part_number,
            'brand'       => $request->brand,
            'unit'        => $request->unit,
            // Quantity tidak diupdate di sini, karena diatur dari transaksi
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(ElectricalPart $electrical)
    {
        $electrical->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
