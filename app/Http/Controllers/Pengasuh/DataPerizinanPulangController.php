<?php

namespace App\Http\Controllers\Pengasuh;

use App\Http\Controllers\Controller;
use App\Models\PerizinanPulang;
use Illuminate\Http\Request;
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
}
