<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prestasi;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanAdminPrestasiController extends Controller
{
    public function index()
    {
        return view('admin.laporan-prestasi.index');
    }

    public function laporanPrestasi(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $prestasi = Prestasi::with('santri')
            ->whereBetween('tanggal_prestasi', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_prestasi', 'asc')
            ->get();

        return view('admin.laporan-prestasi.prestasi', compact('prestasi'));
    }

    public function cetakPrestasiPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $prestasi = Prestasi::with('santri')
            ->whereBetween('tanggal_prestasi', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_prestasi', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.laporan-prestasi.pdf_prestasi', [
            'prestasi' => $prestasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-prestasi.pdf');
    }
}
