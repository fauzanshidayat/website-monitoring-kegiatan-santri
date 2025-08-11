@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h4 class="mb-3">Tambah Prestasi Santri</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('prestasi.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" class="form-control @error('santri_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santri as $item)
                                <option value="{{ $item->id }}" {{ old('santri_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('santri_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Prestasi <span class="text-danger">*</span></label>
                        <select name="jenis_prestasi" class="form-control @error('jenis_prestasi') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Jenis Prestasi --</option>
                            @foreach (['Akademik', 'Non-Akademik', 'Keagamaan'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_prestasi') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Prestasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_prestasi"
                            class="form-control @error('nama_prestasi') is-invalid @enderror"
                            value="{{ old('nama_prestasi') }}" required>
                        @error('nama_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tingkat Prestasi <span class="text-danger">*</span></label>
                        <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                            <option value="">-- Pilih Tingkat --</option>
                            @foreach (['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'] as $tingkat)
                                <option value="{{ $tingkat }}" {{ old('tingkat') == $tingkat ? 'selected' : '' }}>
                                    {{ $tingkat }}
                                </option>
                            @endforeach
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Prestasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_prestasi"
                            class="form-control @error('tanggal_prestasi') is-invalid @enderror"
                            value="{{ old('tanggal_prestasi') }}" required>
                        @error('tanggal_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
