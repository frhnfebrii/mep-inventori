<?php

namespace App\Http\Controllers;

use App\Models\ToolsPart;
use Illuminate\Http\Request;

class ToolsPartController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $toolsParts = ToolsPart::all();
        return view('/admin/tools', compact('toolsParts'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'unit'        => 'required|string',
            'unit_price'  => 'required|numeric',
            'price'       => 'required|numeric',
            'remark'      => 'nullable|string',
        ]);

        ToolsPart::create([
            'description' => $request->description,
            'unit'        => $request->unit,
            'unit_price'  => $request->unit_price,
            'price'       => $request->price,
            'remark'      => $request->remark,
            'quantity'    => 0,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, ToolsPart $tool)
    {
        $request->validate([
            'description' => 'required|string',
            'unit'        => 'required|string',
            'unit_price'  => 'required|numeric',
            'price'       => 'required|numeric',
            'remark'      => 'nullable|string',
        ]);

        $tool->update([
            'description' => $request->description,
            'unit'        => $request->unit,
            'unit_price'  => $request->unit_price,
            'price'       => $request->price,
            'remark'      => $request->remark,
             // Quantity tidak diupdate di sini, karena diatur dari transaksi
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(ToolsPart $tool)
    {
        $tool->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
