<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hafalan;
use App\Models\DataKegiatan;
use PDF;

class LaporanAdminHafalanController extends Controller
{
    public function index()
    {
        $dataKegiatan = DataKegiatan::orderBy('kegiatan')->get();
        return view('admin.laporan-hafalan.index', compact('dataKegiatan'));
    }

    public function laporanHafalan(Request $request)
    {
        $request->validate([
            'data_kegiatan_id' => 'required|exists:data_kegiatan,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $hafalan = Hafalan::with(['santri', 'dataKegiatan'])
            ->where('data_kegiatan_id', $request->data_kegiatan_id)
            ->whereBetween('tanggal_menghafal', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_menghafal', 'asc')
            ->get();

        return view('admin.laporan-hafalan.hafalan', compact('hafalan'));
    }

    public function cetakHafalanPDF(Request $request)
    {
        $request->validate([
            'data_kegiatan_id' => 'required|exists:data_kegiatan,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $hafalan = Hafalan::with(['santri', 'dataKegiatan'])
            ->where('data_kegiatan_id', $request->data_kegiatan_id)
            ->whereBetween('tanggal_menghafal', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('tanggal_menghafal', 'asc')
            ->get();

        $dataKegiatan = DataKegiatan::find($request->data_kegiatan_id);

        $pdf = PDF::loadView('admin.laporan-hafalan.pdf_hafalan', [
            'hafalan' => $hafalan,
            'dataKegiatan' => $dataKegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-hafalan-santri.pdf');
    }
}
