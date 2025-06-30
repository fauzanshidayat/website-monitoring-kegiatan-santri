<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Hafalan;
use App\Models\DataKegiatan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LihatHafalanSayaController extends Controller
{
    /**
     * Menampilkan daftar kegiatan yang diikuti oleh santri.
     */
    public function index()
    {
        // Ambil data santri berdasarkan user yang sedang login
        $santri = Santri::where('user_id', Auth::id())->firstOrFail();

        // Ambil semua kegiatan yang memiliki hafalan dari santri ini
        $dataKegiatanIds = Hafalan::where('santri_id', $santri->id)
            ->pluck('data_kegiatan_id')
            ->unique();

        $kegiatan = DataKegiatan::whereIn('id', $dataKegiatanIds)->get();

        return view('santri.hafalan-saya.index', compact('kegiatan'));
    }

    /**
     * Menampilkan daftar hafalan santri berdasarkan kegiatan.
     */
    public function show(DataKegiatan $dataKegiatan)
    {
        $santri = Santri::where('user_id', Auth::id())->firstOrFail();

        // Ambil semua hafalan dari santri ini untuk kegiatan yang dipilih
        $hafalanList = Hafalan::where('data_kegiatan_id', $dataKegiatan->id)
            ->where('santri_id', $santri->id)
            ->with('dataKegiatan')
            ->get();

        return view('santri.hafalan-saya.show', compact('dataKegiatan', 'hafalanList'));
    }
}
