<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\PerizinanPulang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjukanPerizinanPulangController extends Controller
{
    // Tampilkan semua pengajuan oleh santri
    public function index()
    {
        $santri = Auth::user()->santri;
        $perizinan = PerizinanPulang::where('santri_id', $santri->id)->latest()->get();

        return view('santri.perizinan-pulang.index', compact('perizinan'));
    }

    // Tampilkan form pengajuan
    public function create()
    {
        return view('santri.perizinan-pulang.create');
    }

    // Simpan pengajuan baru
    public function store(Request $request)
    {
        $request->validate([
            'alasan' => 'required|string',
            'tanggal_pulang' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pulang',
        ]);

        $santri = Auth::user()->santri;

        if (!$santri) {
            return redirect()->back()->with('error', 'Data santri tidak ditemukan.');
        }

        PerizinanPulang::create([
            'santri_id' => $santri->id,
            'alasan' => $request->alasan,
            'tanggal_pulang' => $request->tanggal_pulang,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('perizinan-pulang.index')->with('success', 'Pengajuan berhasil dikirim.');
    }

    // Lihat detail pengajuan
    public function show($id)
    {
        $santri = Auth::user()->santri;
        $perizinan = PerizinanPulang::where('santri_id', $santri->id)->findOrFail($id);

        return view('santri.perizinan-pulang.show', compact('perizinan'));
    }

    // Form edit (jika status masih diajukan)
    public function edit($id)
    {
        $santri = Auth::user()->santri;
        $perizinan = PerizinanPulang::where('santri_id', $santri->id)
            ->where('status', 'diajukan')
            ->findOrFail($id);

        return view('santri.perizinan-pulang.edit', compact('perizinan'));
    }

    // Update pengajuan
    public function update(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string',
            'tanggal_pulang' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pulang',
        ]);

        $santri = Auth::user()->santri;
        $perizinan = PerizinanPulang::where('santri_id', $santri->id)
            ->where('status', 'diajukan')
            ->findOrFail($id);

        $perizinan->update([
            'alasan' => $request->alasan,
            'tanggal_pulang' => $request->tanggal_pulang,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('perizinan-pulang.index')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    // Hapus pengajuan
    public function destroy($id)
    {
        $santri = Auth::user()->santri;
        $perizinan = PerizinanPulang::where('santri_id', $santri->id)
            ->where('status', 'diajukan')
            ->findOrFail($id);

        $perizinan->delete();

        return redirect()->route('perizinan-pulang.index')->with('success', 'Pengajuan berhasil dihapus.');
    }
}
