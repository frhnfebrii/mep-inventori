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
        return view('tools', compact('toolsParts'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'quantity'    => 'required|integer',
            'unit'        => 'required|string',
            'unit_price'  => 'required|numeric',
            'price'       => 'required|numeric',
            'remark'      => 'nullable|string',
        ]);

        ToolsPart::create($request->all());

        return redirect()->route('tools.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update(Request $request, ToolsPart $tool)
    {
        $request->validate([
            'description' => 'required|string',
            'quantity'    => 'required|integer',
            'unit'        => 'required|string',
            'unit_price'  => 'required|numeric',
            'price'       => 'required|numeric',
            'remark'      => 'nullable|string',
        ]);

        $tool->update($request->all());

        return redirect()->route('tools.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy(ToolsPart $tool)
    {
        $tool->delete();

        return redirect()->route('tools.index')->with('success', 'Data berhasil dihapus.');
    }
}
