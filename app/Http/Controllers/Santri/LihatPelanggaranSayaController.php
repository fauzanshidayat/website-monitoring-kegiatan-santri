<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use App\Models\DataPelanggaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LihatPelanggaranSayaController extends Controller
{
    /**
     * Menampilkan daftar jenis pelanggaran yang pernah dilakukan oleh santri yang login.
     */
    public function index()
    {
        // Ambil data santri berdasarkan user yang sedang login
        $santri = Santri::where('user_id', Auth::id())->firstOrFail();

        // Ambil semua data_pelanggaran_id yang pernah dilakukan santri ini
        $dataPelanggaranIds = Pelanggaran::where('santri_id', $santri->id)
            ->pluck('data_pelanggaran_id')
            ->unique();

        // Ambil data jenis pelanggaran yang terkait
        $dataPelanggaran = DataPelanggaran::whereIn('id', $dataPelanggaranIds)->get();

        return view('santri.pelanggaran-saya.index', compact('dataPelanggaran'));
    }

    /**
     * Menampilkan detail pelanggaran santri untuk jenis pelanggaran tertentu.
     */
    public function show(DataPelanggaran $dataPelanggaran)
    {
        $santri = Santri::where('user_id', Auth::id())->firstOrFail();

        // Ambil semua pelanggaran dari santri ini untuk jenis pelanggaran yang dipilih
        $pelanggaranList = Pelanggaran::where('data_pelanggaran_id', $dataPelanggaran->id)
            ->where('santri_id', $santri->id)
            ->with('dataPelanggaran')
            ->get();

        return view('santri.pelanggaran-saya.show', compact('dataPelanggaran', 'pelanggaranList'));
    }
}
