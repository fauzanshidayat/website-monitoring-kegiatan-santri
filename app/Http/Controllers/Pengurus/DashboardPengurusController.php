<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\DataKegiatan;
use App\Models\Hafalan;
use Illuminate\Support\Facades\Auth;

class DashboardPengurusController extends Controller
{
    public function index()
    {
        // Ambil pengurus berdasarkan user yang login
        $pengurus = Pengurus::where('user_id', Auth::id())->firstOrFail();

        // Total kegiatan yang diampu
        $totalKegiatan = DataKegiatan::where('pengurus_id', $pengurus->id)->count();

        // Ambil semua ID kegiatan yang diampu oleh pengurus
        $dataKegiatanIds = DataKegiatan::where('pengurus_id', $pengurus->id)->pluck('id');

        // Total hafalan dari kegiatan-kegiatan tersebut
        $totalHafalan = Hafalan::whereIn('data_kegiatan_id', $dataKegiatanIds)->count();

        return view('pengurus.dashboard', compact('totalKegiatan', 'totalHafalan'));
    }
}
