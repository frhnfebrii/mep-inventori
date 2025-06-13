<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricalPart;
use App\Models\ToolsPart;
use App\Models\InstrumentPart;
use App\Models\RiwayatBarangMasuk;

class RiwayatBarangMasukController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatBarangMasuk::with(['electricalPart', 'toolsPart', 'instrumentPart'])->latest()->get();
        $electricalParts = ElectricalPart::all();
        $toolsParts = ToolsPart::all();
        $instrumentParts = InstrumentPart::all();

        return view('masuk', compact('riwayat', 'electricalParts', 'toolsParts', 'instrumentParts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_part' => 'required|in:electrical,tools,instrument',
            'quantity'      => 'required|integer|min:1',
            'unit'          => 'required|string',
            'tanggal'       => 'required|date',
        ]);

        $data = [
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'tanggal' => $request->tanggal,
        ];

        switch ($request->kategori_part) {
            case 'electrical':
                $request->validate(['electrical_part_id' => 'required|exists:electrical_parts,id']);
                $data['electrical_part_id'] = $request->electrical_part_id;

                $part = ElectricalPart::findOrFail($request->electrical_part_id);
                $part->quantity += $request->quantity;
                $part->save();
                break;

            case 'tools':
                $request->validate(['tools_part_id' => 'required|exists:tools_parts,id']);
                $data['tools_part_id'] = $request->tools_part_id;

                $part = ToolsPart::findOrFail($request->tools_part_id);
                $part->quantity += $request->quantity;
                $part->save();
                break;

            case 'instrument':
                $request->validate(['instrument_part_id' => 'required|exists:instrument_parts,id']);
                $data['instrument_part_id'] = $request->instrument_part_id;

                $part = InstrumentPart::findOrFail($request->instrument_part_id);
                $part->quantity += $request->quantity;
                $part->save();
                break;
        }

        RiwayatBarangMasuk::create($data);

        return redirect()->route('masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function edit(RiwayatBarangMasuk $masuk)
    {
        $electricalParts = ElectricalPart::all();
        $toolsParts = ToolsPart::all();
        $instrumentParts = InstrumentPart::all();

        return view('masuk.edit', compact('masuk', 'electricalParts', 'toolsParts', 'instrumentParts'));
    }

    public function update(Request $request, RiwayatBarangMasuk $masuk)
    {
        $request->validate([
            'kategori_part' => 'required|in:electrical,tools,instrument',
            'quantity'      => 'required|integer|min:1',
            'unit'          => 'required|string',
            'tanggal'       => 'required|date',
        ]);

        $oldQuantity = $masuk->quantity;

        // Kurangi stok lama
        if ($masuk->electrical_part_id) {
            $oldPart = ElectricalPart::find($masuk->electrical_part_id);
        } elseif ($masuk->tools_part_id) {
            $oldPart = ToolsPart::find($masuk->tools_part_id);
        } elseif ($masuk->instrument_part_id) {
            $oldPart = InstrumentPart::find($masuk->instrument_part_id);
        }

        if (isset($oldPart)) {
            $oldPart->quantity -= $oldQuantity;
            $oldPart->save();
        }

        // Siapkan data baru
        $data = [
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'tanggal' => $request->tanggal,
            'electrical_part_id' => null,
            'tools_part_id' => null,
            'instrument_part_id' => null,
        ];

        switch ($request->kategori_part) {
            case 'electrical':
                $request->validate(['electrical_part_id' => 'required|exists:electrical_parts,id']);
                $data['electrical_part_id'] = $request->electrical_part_id;

                $newPart = ElectricalPart::find($request->electrical_part_id);
                break;

            case 'tools':
                $request->validate(['tools_part_id' => 'required|exists:tools_parts,id']);
                $data['tools_part_id'] = $request->tools_part_id;

                $newPart = ToolsPart::find($request->tools_part_id);
                break;

            case 'instrument':
                $request->validate(['instrument_part_id' => 'required|exists:instrument_parts,id']);
                $data['instrument_part_id'] = $request->instrument_part_id;

                $newPart = InstrumentPart::find($request->instrument_part_id);
                break;
        }

        $masuk->update($data);

        if (isset($newPart)) {
            $newPart->quantity += $request->quantity;
            $newPart->save();
        }

        return redirect()->route('masuk.index')->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(RiwayatBarangMasuk $masuk)
    {
        if ($masuk->electrical_part_id) {
            $part = ElectricalPart::find($masuk->electrical_part_id);
        } elseif ($masuk->tools_part_id) {
            $part = ToolsPart::find($masuk->tools_part_id);
        } elseif ($masuk->instrument_part_id) {
            $part = InstrumentPart::find($masuk->instrument_part_id);
        }

        if (isset($part)) {
            $part->quantity -= $masuk->quantity;
            $part->save();
        }

        $masuk->delete();

        return redirect()->route('masuk.index')->with('success', 'Data berhasil dihapus.');
    }
}