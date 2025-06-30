<?php

namespace App\Http\Controllers\Pengasuh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Santri;
use App\Models\Pengasuh;
use App\Models\DataPelanggaran;
use App\Models\Pelanggaran;

class PelanggaranSantriController extends Controller
{
    /**
     * Menampilkan daftar pelanggaran yang di-input oleh pengasuh (yang login).
     */
    public function index()
    {
        $pengasuh = Pengasuh::where('user_id', Auth::id())->first();

        // Ambil semua data pelanggaran yang dibuat oleh pengasuh ini
        $dataPelanggaran = DataPelanggaran::where('pengasuh_id', $pengasuh->id)->get();

        return view('pengasuh.pelanggaran-santri.index', compact('dataPelanggaran'));
    }

    /**
     * Menampilkan form untuk menambah pelanggaran untuk data pelanggaran tertentu.
     * Contoh: pelanggaran tertentu (misal pelanggaran disiplin ringan) lalu santri yang melanggar.
     */
    public function create(DataPelanggaran $dataPelanggaran)
    {
        $santri = Santri::all();

        return view('pengasuh.pelanggaran-santri.create', compact('dataPelanggaran', 'santri'));
    }

    /**
     * Simpan data pelanggaran santri ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'data_pelanggaran_id' => 'required|exists:data_pelanggaran,id',
            'keterangan' => 'nullable|string',
            'tanggal_melanggar' => 'required|date',
        ]);

        Pelanggaran::create($request->all());

        return redirect()->route('pengasuh.pelanggaran.show', $request->data_pelanggaran_id)
            ->with('success', 'Data pelanggaran berhasil dicatat.');
    }

    /**
     * Tampilkan daftar pelanggaran santri untuk jenis pelanggaran tertentu.
     */
    public function show(DataPelanggaran $dataPelanggaran)
    {
        $pelanggaranList = Pelanggaran::where('data_pelanggaran_id', $dataPelanggaran->id)
            ->with(['santri', 'dataPelanggaran'])
            ->get();

        return view('pengasuh.pelanggaran-santri.show', compact('dataPelanggaran', 'pelanggaranList'));
    }

    /**
     * Form edit pelanggaran.
     */
    public function edit(Pelanggaran $pelanggaran)
    {
        $santri = Santri::all();
        $dataPelanggaran = $pelanggaran->dataPelanggaran;

        return view('pengasuh.pelanggaran-santri.edit', compact('pelanggaran', 'santri', 'dataPelanggaran'));
    }

    /**
     * Update data pelanggaran.
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'keterangan' => 'nullable|string',
            'tanggal_melanggar' => 'required|date',
        ]);

        $pelanggaran->update($request->all());

        return redirect()->route('pengasuh.pelanggaran.show', $pelanggaran->data_pelanggaran_id)
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    /**
     * Hapus data pelanggaran.
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        $dataPelanggaranId = $pelanggaran->data_pelanggaran_id;
        $pelanggaran->delete();

        return redirect()->route('pengasuh.pelanggaran.show', $dataPelanggaranId)
            ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
