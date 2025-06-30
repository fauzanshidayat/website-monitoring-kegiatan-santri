<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hafalan;
use App\Models\DataKegiatan;
use Illuminate\Http\Request;

class LihatDataHafalanSantriController extends Controller
{
    /**
     * Menampilkan semua kegiatan yang memiliki hafalan dari santri manapun.
     */
    public function index()
    {
        // Ambil semua ID kegiatan yang punya data hafalan
        $dataKegiatanIds = Hafalan::pluck('data_kegiatan_id')->unique();

        // Ambil semua data kegiatan terkait
        $kegiatan = DataKegiatan::whereIn('id', $dataKegiatanIds)
            ->with('pengurus') // include pengurus
            ->get();

        return view('admin.hafalan-santri.index', compact('kegiatan'));
    }

    /**
     * Menampilkan semua data hafalan berdasarkan kegiatan yang dipilih.
     */
    public function show(DataKegiatan $dataKegiatan)
    {
        // Ambil semua hafalan dari semua santri untuk kegiatan ini
        $hafalanList = Hafalan::where('data_kegiatan_id', $dataKegiatan->id)
            ->with(['santri', 'dataKegiatan'])
            ->get();

        return view('admin.hafalan-santri.show', compact('dataKegiatan', 'hafalanList'));
    }
}
