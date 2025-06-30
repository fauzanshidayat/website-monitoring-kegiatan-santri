<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Santri;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SantriController extends Controller
{
    // Tampilkan semua data santri
    public function index()
    {
        $santri = Santri::with('user', 'kelas')->get();
        return view('admin.data-santri.index', compact('santri'));
    }

    // Form tambah santri baru
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.data-santri.create', compact('kelas'));
    }

    // Simpan data santri baru & user-nya
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',

            'nama_lengkap' => 'required|string',
            'nis' => 'required|unique:santri,nis',
            'nisn' => 'nullable|unique:santri,nisn',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'wali_santri' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'no_hp_wali_santri' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'santri',
            ]);

            $photoPath = $request->hasFile('photo')
                ? $request->file('photo')->store('photo-santri', 'public')
                : null;

            Santri::create([
                'user_id' => $user->id,
                'photo' => $photoPath,
                'nama_lengkap' => $request->nama_lengkap,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'wali_santri' => $request->wali_santri,
                'no_hp_wali_santri' => $request->no_hp_wali_santri,
            ]);
        });

        return redirect()->route('santri.index')->with('success', 'Santri berhasil ditambahkan.');
    }

    public function show($id)
    {
        $santri = Santri::with('user', 'kelas')->findOrFail($id);
        return view('admin.data-santri.show', compact('santri'));
    }

    // Form edit data santri & akun
    public function edit($id)
    {
        $santri = Santri::with('user')->findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.data-santri.edit', compact('santri', 'kelas'));
    }

    // Update data santri & user
    public function update(Request $request, $id)
    {
        $santri = Santri::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $santri->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'nama_lengkap' => 'required|string',
            'nis' => 'required|unique:santri,nis,' . $id,
            'nisn' => 'nullable|unique:santri,nisn,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'wali_santri' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'no_hp_wali_santri' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $santri) {
            // Update akun user
            $santri->user->username = $request->username;
            if ($request->filled('password')) {
                $santri->user->password = Hash::make($request->password);
            }
            $santri->user->save();

            // Handle photo baru
            if ($request->hasFile('photo')) {
                if ($santri->photo) {
                    Storage::disk('public')->delete($santri->photo);
                }
                $santri->photo = $request->file('photo')->store('photo-santri', 'public');
            }

            // Update data santri
            $santri->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'wali_santri' => $request->wali_santri,
                'photo' => $santri->photo,
                'no_hp_wali_santri' => $request->no_hp_wali_santri,
            ]);
        });

        return redirect()->route('santri.index')->with('success', 'Santri berhasil diperbarui.');
    }

    // Hapus data santri & user-nya
    public function destroy($id)
    {
        $santri = Santri::with('user')->findOrFail($id);

        DB::transaction(function () use ($santri) {
            if ($santri->photo) {
                Storage::disk('public')->delete($santri->photo);
            }

            // karena ada foreign key dengan `onDelete('cascade')`
            // kita cukup hapus user-nya, santri-nya ikut hilang
            $santri->user->delete();
        });

        return redirect()->route('santri.index')->with('success', 'Santri berhasil dihapus.');
    }
}
