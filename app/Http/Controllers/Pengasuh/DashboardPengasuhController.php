<?php

namespace App\Http\Controllers\Pengasuh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPelanggaran;
use App\Models\Pelanggaran;
use App\Models\PerizinanPulang;
use Illuminate\Support\Facades\Auth;

class DashboardPengasuhController extends Controller
{
    public function index()
    {
        $pengasuhId = Auth::user()->pengasuh->id ?? null;

        $totalDataPelanggaran = DataPelanggaran::where('pengasuh_id', $pengasuhId)->count();

        // Ambil semua data_pelanggaran yang dibuat oleh pengasuh ini
        $dataPelanggaranIds = DataPelanggaran::where('pengasuh_id', $pengasuhId)->pluck('id');

        $totalPelanggaranSantri = Pelanggaran::whereIn('data_pelanggaran_id', $dataPelanggaranIds)->count();

        $totalPerizinanPulang = PerizinanPulang::count();

        return view('pengasuh.dashboard', compact(
            'totalDataPelanggaran',
            'totalPelanggaranSantri',
            'totalPerizinanPulang'
        ));
    }
}
