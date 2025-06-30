<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pengurus;
use App\Models\Pengasuh;
use App\Models\Santri;
use App\Models\DataKegiatan;
use App\Models\DataPelanggaran;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalKelas = Kelas::count();
        $totalPengurus = Pengurus::count();
        $totalPengasuh = Pengasuh::count();
        $totalSantri = Santri::count();
        $totalKegiatan = DataKegiatan::count();
        $totalPelanggaran = DataPelanggaran::count();

        return view('admin.dashboard', compact(
            'totalKelas',
            'totalPengurus',
            'totalPengasuh',
            'totalSantri',
            'totalKegiatan',
            'totalPelanggaran'
        ));
    }
}
