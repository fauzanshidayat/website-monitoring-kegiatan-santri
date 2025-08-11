<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class LihatDataPrestasiSantriController extends Controller
{
    /**
     * Menampilkan semua data perizinan pulang santri
     */
    public function index()
    {
        $dataPrestasi = Prestasi::with('santri')->latest()->get();

        return view('admin.prestasi-santri.index', compact('dataPrestasi'));
    }

    /**
     * Menampilkan detail perizinan pulang berdasarkan ID
     */
    public function show($id)
    {
        $prestasi = Prestasi::with('santri')->findOrFail($id);

        return view('admin.prestasi-santri.show', compact('prestasi'));
    }
}
