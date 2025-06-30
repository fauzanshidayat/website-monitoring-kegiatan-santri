<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerizinanPulang;
use PDF;

class LaporanAdminPerizinanPulangController extends Controller
{
    public function index()
    {
        return view('admin.laporan-perizinan-pulang.index');
    }

    public function laporanPerizinanPulang(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $perizinan = PerizinanPulang::with(['santri', 'pengasuh'])
            ->whereBetween('tanggal_pulang', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_pulang', 'asc')
            ->get();

        return view('admin.laporan-perizinan-pulang.perizinan-pulang', compact('perizinan'));
    }

    public function cetakPerizinanPulangPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $perizinan = PerizinanPulang::with(['santri', 'pengasuh'])
            ->whereBetween('tanggal_pulang', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_pulang', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.laporan-perizinan-pulang.pdf_perizinan-pulang', [
            'perizinan' => $perizinan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-perizinan-pulang.pdf');
    }
}
