<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricalPart;
use App\Models\ToolsPart;
use App\Models\InstrumentPart;
use App\Models\RiwayatBarangKeluar;

class RiwayatBarangKeluarController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatBarangKeluar::with(['electricalPart', 'toolsPart', 'instrumentPart'])->latest()->get();
        $electricalParts = ElectricalPart::all();
        $toolsParts = ToolsPart::all();
        $instrumentParts = InstrumentPart::all();

        return view('keluar', compact('riwayat', 'electricalParts', 'toolsParts', 'instrumentParts'));
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
                
                // Validasi stok cukup
                if ($part->quantity < $request->quantity) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $part->quantity]);
                }
                
                $part->quantity -= $request->quantity; // Perbedaan utama: mengurangi stok
                $part->save();
                break;

            case 'tools':
                $request->validate(['tools_part_id' => 'required|exists:tools_parts,id']);
                $data['tools_part_id'] = $request->tools_part_id;

                $part = ToolsPart::findOrFail($request->tools_part_id);
                
                if ($part->quantity < $request->quantity) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $part->quantity]);
                }
                
                $part->quantity -= $request->quantity;
                $part->save();
                break;

            case 'instrument':
                $request->validate(['instrument_part_id' => 'required|exists:instrument_parts,id']);
                $data['instrument_part_id'] = $request->instrument_part_id;

                $part = InstrumentPart::findOrFail($request->instrument_part_id);
                
                if ($part->quantity < $request->quantity) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $part->quantity]);
                }
                
                $part->quantity -= $request->quantity;
                $part->save();
                break;
        }

        RiwayatBarangKeluar::create($data);

        return redirect()->route('keluar.index')->with('success', 'Barang keluar berhasil dicatat.');
    }

    public function edit(RiwayatBarangKeluar $keluar)
    {
        $electricalParts = ElectricalPart::all();
        $toolsParts = ToolsPart::all();
        $instrumentParts = InstrumentPart::all();

        return view('keluar.edit', compact('keluar', 'electricalParts', 'toolsParts', 'instrumentParts'));
    }

    public function update(Request $request, RiwayatBarangKeluar $keluar)
    {
        $request->validate([
            'kategori_part' => 'required|in:electrical,tools,instrument',
            'quantity'      => 'required|integer|min:1',
            'unit'          => 'required|string',
            'tanggal'       => 'required|date',
        ]);

        $oldQuantity = $keluar->quantity;

        // Kembalikan stok lama
        if ($keluar->electrical_part_id) {
            $oldPart = ElectricalPart::find($keluar->electrical_part_id);
        } elseif ($keluar->tools_part_id) {
            $oldPart = ToolsPart::find($keluar->tools_part_id);
        } elseif ($keluar->instrument_part_id) {
            $oldPart = InstrumentPart::find($keluar->instrument_part_id);
        }

        if (isset($oldPart)) {
            $oldPart->quantity += $oldQuantity; // Kembalikan stok lama
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
                
                // Validasi stok cukup untuk pengurangan baru
                $netChange = $oldQuantity - $request->quantity;
                if ($newPart->quantity < $netChange) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk perubahan ini']);
                }
                break;

            case 'tools':
                $request->validate(['tools_part_id' => 'required|exists:tools_parts,id']);
                $data['tools_part_id'] = $request->tools_part_id;

                $newPart = ToolsPart::find($request->tools_part_id);
                
                $netChange = $oldQuantity - $request->quantity;
                if ($newPart->quantity < $netChange) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk perubahan ini']);
                }
                break;

            case 'instrument':
                $request->validate(['instrument_part_id' => 'required|exists:instrument_parts,id']);
                $data['instrument_part_id'] = $request->instrument_part_id;

                $newPart = InstrumentPart::find($request->instrument_part_id);
                
                $netChange = $oldQuantity - $request->quantity;
                if ($newPart->quantity < $netChange) {
                    return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk perubahan ini']);
                }
                break;
        }

        $keluar->update($data);

        if (isset($newPart)) {
            $newPart->quantity -= $request->quantity; // Kurangi stok baru
            $newPart->save();
        }

        return redirect()->route('keluar.index')->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    public function destroy(RiwayatBarangKeluar $keluar)
    {
        if ($keluar->electrical_part_id) {
            $part = ElectricalPart::find($keluar->electrical_part_id);
        } elseif ($keluar->tools_part_id) {
            $part = ToolsPart::find($keluar->tools_part_id);
        } elseif ($keluar->instrument_part_id) {
            $part = InstrumentPart::find($keluar->instrument_part_id);
        }

        if (isset($part)) {
            $part->quantity += $keluar->quantity; // Kembalikan stok saat dihapus
            $part->save();
        }

        $keluar->delete();

        return redirect()->route('keluar.index')->with('success', 'Data berhasil dihapus.');
    }
}