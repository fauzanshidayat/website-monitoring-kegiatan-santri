<?php

namespace App\Http\Controllers\Santri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Auth;

class LihatPrestasiSayaController extends Controller
{

    public function index()
    {
        $santri = Auth::user()->santri;
        $prestasi = Prestasi::where('santri_id', $santri->id)->latest()->get();

        return view('santri.prestasi-saya.index', compact('prestasi'));
    }

    public function show($id)
    {
        $santri = Auth::user()->santri;
        $prestasi = Prestasi::where('santri_id', $santri->id)->findOrFail($id);

        return view('santri.prestasi-saya.show', compact('prestasi'));
    }
}
