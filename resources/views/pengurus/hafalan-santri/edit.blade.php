@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h3 class="page-title text-dark font-weight-medium mb-1">Edit Hafalan - {{ $dataKegiatan->kegiatan }}</h3>

        <h5 class="mb-3">Informasi Kegiatan:</h5>
        <ul>
            <li><strong>Hari:</strong> {{ $dataKegiatan->hari }}</li>
            <li><strong>Jam:</strong> {{ \Carbon\Carbon::parse($dataKegiatan->jam)->format('H:i') }}</li>
            <li><strong>Pengajar:</strong> {{ $dataKegiatan->pengurus->nama_lengkap ?? '-' }}</li>
        </ul>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengurus.hafalan.update', $hafalan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="data_kegiatan_id" value="{{ $dataKegiatan->id }}">

                    <div class="form-group">
                        <label>Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" class="form-control @error('santri_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santri as $s)
                                <option value="{{ $s->id }}"
                                    {{ old('santri_id', $hafalan->santri_id) == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('santri_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Hafalan <span class="text-danger">*</span></label>
                        <select name="jenis_hafalan" class="form-control @error('jenis_hafalan') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach (['surah', 'kitab', 'doa', 'lainnya'] as $jenis)
                                <option value="{{ $jenis }}"
                                    {{ old('jenis_hafalan', $hafalan->jenis_hafalan) == $jenis ? 'selected' : '' }}>
                                    {{ ucfirst($jenis) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_hafalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Kitab / Surah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kitab_surah"
                            class="form-control @error('nama_kitab_surah') is-invalid @enderror"
                            value="{{ old('nama_kitab_surah', $hafalan->nama_kitab_surah) }}" required>
                        @error('nama_kitab_surah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Bab / Juz <span class="text-danger">*</span></label>
                        <input type="text" name="bab_juz" class="form-control @error('bab_juz') is-invalid @enderror"
                            value="{{ old('bab_juz', $hafalan->bab_juz) }}" required>
                        @error('bab_juz')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Progres Belajar <span class="text-danger">*</span></label>
                        <input type="text" name="progres_belajar"
                            class="form-control @error('progres_belajar') is-invalid @enderror"
                            value="{{ old('progres_belajar', $hafalan->progres_belajar) }}" required>
                        @error('progres_belajar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $hafalan->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Menghafal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_menghafal"
                            class="form-control @error('tanggal_menghafal') is-invalid @enderror"
                            value="{{ old('tanggal_menghafal', \Carbon\Carbon::parse($hafalan->tanggal_menghafal)->format('Y-m-d')) }}"
                            required>
                        @error('tanggal_menghafal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('pengurus.hafalan.show', $dataKegiatan->id) }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
