<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengasuh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengasuhController extends Controller
{
    public function index()
    {
        $pengasuh = Pengasuh::with('user')->get();
        return view('admin.data-pengasuh.index', compact('pengasuh'));
    }

    public function create()
    {
        return view('admin.data-pengasuh.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',

            'nama_lengkap' => 'required|string',
            'nip' => 'required|string|max:50|unique:pengasuh,nip',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'pengasuh',
            ]);

            $photoPath = $request->hasFile('photo')
                ? $request->file('photo')->store('photo-pengasuh', 'public')
                : null;

            Pengasuh::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'photo' => $photoPath,
            ]);
        });

        return redirect()->route('pengasuh.index')->with('success', 'Pengasuh berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengasuh = Pengasuh::with('user')->findOrFail($id);
        return view('admin.data-pengasuh.show', compact('pengasuh'));
    }

    public function edit($id)
    {
        $pengasuh = Pengasuh::with('user')->findOrFail($id);
        return view('admin.data-pengasuh.edit', compact('pengasuh'));
    }

    public function update(Request $request, $id)
    {
        $pengasuh = Pengasuh::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $pengasuh->user->id,
            'password' => 'nullable|string|min:6|confirmed',

            'nama_lengkap' => 'required|string',
            'nip' => 'required|string|max:50|unique:pengasuh,nip,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request, $pengasuh) {
            // Update user
            $pengasuh->user->username = $request->username;
            if ($request->filled('password')) {
                $pengasuh->user->password = Hash::make($request->password);
            }
            $pengasuh->user->save();

            // Update photo jika ada upload baru
            if ($request->hasFile('photo')) {
                if ($pengasuh->photo) {
                    Storage::disk('public')->delete($pengasuh->photo);
                }
                $pengasuh->photo = $request->file('photo')->store('photo-pengasuh', 'public');
            }

            $pengasuh->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'photo' => $pengasuh->photo,
            ]);
        });

        return redirect()->route('pengasuh.index')->with('success', 'Pengasuh berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengasuh = Pengasuh::with('user')->findOrFail($id);

        DB::transaction(function () use ($pengasuh) {
            if ($pengasuh->photo) {
                Storage::disk('public')->delete($pengasuh->photo);
            }

            // Karena FK dengan onDelete cascade, hapus user otomatis hapus pengasuh
            $pengasuh->user->delete();
        });

        return redirect()->route('pengasuh.index')->with('success', 'Pengasuh berhasil dihapus.');
    }
}
