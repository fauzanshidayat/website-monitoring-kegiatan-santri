<?php

namespace App\Http\Controllers\Pengasuh;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Santri;
use Illuminate\Http\Request;

class PrestasiSantriController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::with('santri')->latest()->get();
        return view('pengasuh.prestasi-santri.index', compact('prestasi'));
    }

    public function create()
    {
        $santri = Santri::all();
        return view('pengasuh.prestasi-santri.create', compact('santri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'jenis_prestasi' => 'required|string|max:255',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tanggal_prestasi' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        Prestasi::create($request->all());

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $prestasi = Prestasi::with('santri')->findOrFail($id);
        return view('pengasuh.prestasi-santri.show', compact('prestasi'));
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $santri = Santri::all();
        return view('pengasuh.prestasi-santri.edit', compact('prestasi', 'santri'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'jenis_prestasi' => 'required|string|max:255',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tanggal_prestasi' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update($request->all());

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
