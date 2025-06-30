<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPelanggaran;
use App\Models\Pengasuh;
use Illuminate\Http\Request;

class DataPelanggaranController extends Controller
{
    public function index()
    {
        $pelanggaran = DataPelanggaran::with('pengasuh')->paginate(10);
        return view('admin.data-pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $pengasuh = Pengasuh::all();
        return view('admin.data-pelanggaran.create', compact('pengasuh'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggaran' => 'required|string|max:255',
            'jenis_pelanggaran' => 'required|in:ringan,sedang,berat',
            'hukuman' => 'required|string|max:255',
            'pengasuh_id' => 'required|exists:pengasuh,id',
        ]);

        DataPelanggaran::create($validated);

        return redirect()->route('data-pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dataPelanggaran = DataPelanggaran::with('pengasuh')->findOrFail($id);
        return view('admin.data-pelanggaran.show', compact('dataPelanggaran'));
    }

    public function edit($id)
    {
        $dataPelanggaran = DataPelanggaran::findOrFail($id);
        $pengasuh = Pengasuh::all();
        return view('admin.data-pelanggaran.edit', compact('dataPelanggaran', 'pengasuh'));
    }

    public function update(Request $request, $id)
    {
        $dataPelanggaran = DataPelanggaran::findOrFail($id);

        $validated = $request->validate([
            'pelanggaran' => 'required|string|max:255',
            'jenis_pelanggaran' => 'required|in:ringan,sedang,berat',
            'hukuman' => 'required|string|max:255',
            'pengasuh_id' => 'required|exists:pengasuh,id',
        ]);

        $dataPelanggaran->update($validated);

        return redirect()->route('data-pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataPelanggaran = DataPelanggaran::findOrFail($id);
        $dataPelanggaran->delete();

        return redirect()->route('data-pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
