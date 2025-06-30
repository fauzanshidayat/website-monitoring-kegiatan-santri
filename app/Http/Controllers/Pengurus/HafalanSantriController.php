<?php

namespace App\Http\Controllers\Pengurus;

use App\Models\Santri;
use App\Models\Pengurus;
use App\Models\Hafalan;
use App\Models\DataKegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HafalanSantriController extends Controller
{
    /**
     * Menampilkan daftar kegiatan yang diampu oleh pengurus.
     */
    public function index()
    {
        $pengurus = Pengurus::where('user_id', Auth::id())->first();

        $kegiatan = DataKegiatan::where('pengurus_id', $pengurus->id)
            ->with('pengurus')
            ->get();

        return view('pengurus.hafalan-santri.index', compact('kegiatan'));
    }

    /**
     * Menampilkan form untuk mencatat hafalan berdasarkan kegiatan tertentu.
     */
    public function create(DataKegiatan $dataKegiatan)
    {
        // Ambil daftar santri (misal berdasarkan kelas, kalau sudah ada relasinya)
        $santri = Santri::all(); // Bisa difilter berdasarkan kelas kegiatan jika ada relasi

        return view('pengurus.hafalan-santri.create', compact('dataKegiatan', 'santri'));
    }

    /**
     * Menyimpan data hafalan ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'data_kegiatan_id' => 'required|exists:data_kegiatan,id',
            'jenis_hafalan' => 'required|in:surah,kitab,doa,lainnya',
            'nama_kitab_surah' => 'required|string',
            'bab_juz' => 'required|string',
            'progres_belajar' => 'required|string',
            'keterangan' => 'nullable|string',
            'tanggal_menghafal' => 'required|date',
        ]);

        Hafalan::create($request->all());

        return redirect()->route('pengurus.hafalan.show', $request->data_kegiatan_id)
            ->with('success', 'Data hafalan berhasil dicatat.');
    }


    /**
     * Menampilkan daftar hafalan untuk kegiatan tertentu.
     */
    public function show(DataKegiatan $dataKegiatan)
    {

        $hafalanList = Hafalan::where('data_kegiatan_id', $dataKegiatan->id)
            ->with(['santri', 'dataKegiatan'])
            ->get();

        return view('pengurus.hafalan-santri.show', compact('dataKegiatan', 'hafalanList'));
    }
    public function edit(Hafalan $hafalan)
    {
        $santri = Santri::all();
        $dataKegiatan = $hafalan->dataKegiatan;  // pastikan relasi sudah ada di model Hafalan

        return view('pengurus.hafalan-santri.edit', compact('hafalan', 'santri', 'dataKegiatan'));
    }


    public function update(Request $request, Hafalan $hafalan)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'jenis_hafalan' => 'required|in:surah,kitab,doa,lainnya',
            'nama_kitab_surah' => 'required|string',
            'bab_juz' => 'required|string',
            'progres_belajar' => 'required|string',
            'keterangan' => 'nullable|string',
            'tanggal_menghafal' => 'required|date',
        ]);

        $hafalan->update($request->all());

        // Redirect balik ke halaman show hafalan sesuai data_kegiatan_id
        return redirect()->route('pengurus.hafalan.show', $hafalan->data_kegiatan_id)
            ->with('success', 'Data hafalan berhasil diperbarui.');
    }

    public function destroy(Hafalan $hafalan)
    {
        $dataKegiatanId = $hafalan->data_kegiatan_id;
        $hafalan->delete();

        return redirect()->route('pengurus.hafalan.show', $dataKegiatanId)
            ->with('success', 'Data hafalan berhasil dihapus.');
    }
}
