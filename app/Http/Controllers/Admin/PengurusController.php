<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with('user')->get();
        return view('admin.data-pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.data-pengurus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',

            'nama_lengkap' => 'required|string',
            'nip' => 'required|string|max:50|unique:pengurus,nip',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'pengurus',
            ]);

            $photoPath = $request->hasFile('photo')
                ? $request->file('photo')->store('photo-pengurus', 'public')
                : null;

            Pengurus::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'photo' => $photoPath,
            ]);
        });

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengurus = Pengurus::with('user')->findOrFail($id);
        return view('admin.data-pengurus.show', compact('pengurus'));
    }

    public function edit($id)
    {
        $pengurus = Pengurus::with('user')->findOrFail($id);
        return view('admin.data-pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $pengurus->user->id,
            'password' => 'nullable|string|min:6|confirmed',

            'nama_lengkap' => 'required|string',
            'nip' => 'required|string|max:50|unique:pengurus,nip,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request, $pengurus) {
            // Update user
            $pengurus->user->username = $request->username;
            if ($request->filled('password')) {
                $pengurus->user->password = Hash::make($request->password);
            }
            $pengurus->user->save();

            if ($request->hasFile('photo')) {
                if ($pengurus->photo) {
                    Storage::disk('public')->delete($pengurus->photo);
                }
                $pengurus->photo = $request->file('photo')->store('photo-pengurus', 'public');
            }

            $pengurus->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'photo' => $pengurus->photo,
            ]);
        });

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::with('user')->findOrFail($id);

        DB::transaction(function () use ($pengurus) {
            if ($pengurus->photo) {
                Storage::disk('public')->delete($pengurus->photo);
            }

            // Karena FK `onDelete('cascade')`, cukup hapus user
            $pengurus->user->delete();
        });

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}
