<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\DataPelanggaran;
use PDF;

class LaporanAdminPelanggaranController extends Controller
{
    public function index()
    {
        $dataPelanggaran = DataPelanggaran::orderBy('pelanggaran')->get();
        return view('admin.laporan-pelanggaran.index', compact('dataPelanggaran'));
    }

    public function laporanPelanggaran(Request $request)
    {
        $request->validate([
            'data_pelanggaran_id' => 'required|exists:data_pelanggaran,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pelanggaran = Pelanggaran::with(['santri', 'dataPelanggaran'])
            ->where('data_pelanggaran_id', $request->data_pelanggaran_id)
            ->whereBetween('tanggal_melanggar', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_melanggar', 'asc')
            ->get();

        return view('admin.laporan-pelanggaran.pelanggaran', compact('pelanggaran'));
    }

    public function cetakPelanggaranPDF(Request $request)
    {
        $request->validate([
            'data_pelanggaran_id' => 'required|exists:data_pelanggaran,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pelanggaran = Pelanggaran::with(['santri', 'dataPelanggaran'])
            ->where('data_pelanggaran_id', $request->data_pelanggaran_id)
            ->whereBetween('tanggal_melanggar', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_melanggar', 'asc')
            ->get();

        $dataPelanggaran = DataPelanggaran::find($request->data_pelanggaran_id);

        $pdf = PDF::loadView('admin.laporan-pelanggaran.pdf_pelanggaran', [
            'pelanggaran' => $pelanggaran,
            'dataPelanggaran' => $dataPelanggaran,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pelanggaran-santri.pdf');
    }
}
