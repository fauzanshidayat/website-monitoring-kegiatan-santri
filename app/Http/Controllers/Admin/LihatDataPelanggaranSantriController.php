<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class LihatDataPelanggaranSantriController extends Controller
{
    /**
     * Menampilkan semua jenis pelanggaran yang pernah dilakukan santri.
     */
    public function index()
    {
        // Ambil semua ID data pelanggaran yang digunakan
        $dataPelanggaranIds = Pelanggaran::pluck('data_pelanggaran_id')->unique();

        // Ambil data pelanggaran yang memiliki catatan
        $dataPelanggaran = DataPelanggaran::whereIn('id', $dataPelanggaranIds)
            ->with('pengasuh') // jika ada relasi ke pengasuh
            ->get();

        return view('admin.pelanggaran-santri.index', compact('dataPelanggaran'));
    }

    /**
     * Menampilkan semua pelanggaran santri untuk jenis pelanggaran tertentu.
     */
    public function show(DataPelanggaran $dataPelanggaran)
    {
        // Ambil semua pelanggaran berdasarkan jenis pelanggaran
        $pelanggaranList = Pelanggaran::where('data_pelanggaran_id', $dataPelanggaran->id)
            ->with(['santri', 'dataPelanggaran'])
            ->get();

        return view('admin.pelanggaran-santri.show', compact('dataPelanggaran', 'pelanggaranList'));
    }
}
