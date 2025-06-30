<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKegiatan;
use App\Models\Pengurus;

class DataKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kegiatan beserta relasi pengurus
        $dataKegiatan = DataKegiatan::with('pengurus')->get();
        return view('admin.data-kegiatan.index', compact('dataKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data pengurus untuk dropdown di form
        $pengurus = Pengurus::all();
        return view('admin.data-kegiatan.create', compact('pengurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kegiatan' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required|date_format:H:i',
            'pengurus_id' => 'required|exists:pengurus,id',
        ]);

        DataKegiatan::create($validated);

        return redirect()->route('data-kegiatan.index')->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataKegiatan = DataKegiatan::with('pengurus', 'hafalan')->findOrFail($id);
        return view('admin.data-kegiatan.show', compact('dataKegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataKegiatan = DataKegiatan::findOrFail($id);
        $pengurus = Pengurus::all();
        return view('admin.data-kegiatan.edit', compact('dataKegiatan', 'pengurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataKegiatan = DataKegiatan::findOrFail($id);

        $validated = $request->validate([
            'kegiatan' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required|date_format:H:i',
            'pengurus_id' => 'required|exists:pengurus,id',
        ]);

        $dataKegiatan->update($validated);

        return redirect()->route('data-kegiatan.index')->with('success', 'Data kegiatan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKegiatan = DataKegiatan::findOrFail($id);
        $dataKegiatan->delete();

        return redirect()->route('data-kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
