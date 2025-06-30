@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h4 class="mb-3">Tambah Data Kegiatan Baru</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-kegiatan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror"
                            value="{{ old('kegiatan') }}" required>
                        @error('kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Hari <span class="text-danger">*</span></label>
                        <select name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>
                        @error('hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jam <span class="text-danger">*</span></label>
                        <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                            value="{{ old('jam') }}" required>
                        @error('jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Pengurus/Pengajar<span class="text-danger">*</span></label>
                        <select name="pengurus_id" class="form-control @error('pengurus_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Pengurus --</option>
                            @foreach ($pengurus as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pengurus_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengurus_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('data-kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
