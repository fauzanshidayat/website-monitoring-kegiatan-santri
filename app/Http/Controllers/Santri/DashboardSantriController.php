<?php

namespace App\Http\Controllers\Santri;

use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use App\Models\PerizinanPulang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardSantriController extends Controller
{
    public function index()
    {
        $santri = Santri::where('user_id', Auth::id())->firstOrFail();

        $totalHafalan = $santri->hafalan()->count();
        $totalPelanggaran = $santri->pelanggaran()->count();
        $totalPrestasi = $santri->prestasi()->count();
        $totalPerizinan = $santri->perizinanPulang()->count();

        return view('santri.dashboard', compact(
            'totalHafalan',
            'totalPelanggaran',
            'totalPerizinan',
            'totalPrestasi'
        ));
    }
}
