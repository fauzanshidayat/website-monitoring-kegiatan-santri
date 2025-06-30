<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerizinanPulang;

class LihatDataPerizinanPulangSantriController extends Controller
{
    /**
     * Menampilkan semua data perizinan pulang santri
     */
    public function index()
    {
        $dataPerizinan = PerizinanPulang::with(['santri', 'pengasuh'])->latest()->get();

        return view('admin.perizinan-pulang.index', compact('dataPerizinan'));
    }

    /**
     * Menampilkan detail perizinan pulang berdasarkan ID
     */
    public function show($id)
    {
        $izin = PerizinanPulang::with(['santri', 'pengasuh'])->findOrFail($id);

        return view('admin.perizinan-pulang.show', compact('izin'));
    }
}
