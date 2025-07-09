<?php

namespace App\Http\Controllers\Pengasuh;

use PDF;
use Illuminate\Http\Request;
use App\Models\PerizinanPulang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPerizinanPulangController extends Controller
{
    // Tampilkan semua pengajuan
    public function index()
    {
        $data = PerizinanPulang::with('santri')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengasuh.data-perizinan-pulang.index', compact('data'));
    }

    // Tampilkan detail pengajuan
    public function show($id)
    {
        $perizinan = PerizinanPulang::with(['santri', 'pengasuh'])->findOrFail($id);

        return view('pengasuh.data-perizinan-pulang.show', compact('perizinan'));
    }

    // Update status pengajuan (setujui / tolak)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $perizinan = PerizinanPulang::where('status', 'diajukan')->findOrFail($id);

        $perizinan->update([
            'status' => $request->status,
            'pengasuh_id' => Auth::user()->pengasuh->id ?? null,
        ]);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    // Fitur cetak surat perizinan
    public function print($id)
    {
        $perizinan = PerizinanPulang::with('santri')->findOrFail($id);

        // Generate PDF from the view
        $pdf = PDF::loadView('pengasuh.data-perizinan-pulang.surat-perizinan', compact('perizinan'));

        // Return PDF to browser
        return $pdf->download('surat_perizinan_pulang_' . $perizinan->id . '.pdf');
    }
}
