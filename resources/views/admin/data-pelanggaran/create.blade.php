@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h4 class="mb-3">Tambah Data Pelanggaran Baru</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-pelanggaran.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Pelanggaran <span class="text-danger">*</span></label>
                        <input type="text" name="pelanggaran"
                            class="form-control @error('pelanggaran') is-invalid @enderror" value="{{ old('pelanggaran') }}"
                            required>
                        @error('pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Pelanggaran <span class="text-danger">*</span></label>
                        <select name="jenis_pelanggaran"
                            class="form-control @error('jenis_pelanggaran') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Pelanggaran --</option>
                            <option value="ringan" {{ old('jenis_pelanggaran') == 'ringan' ? 'selected' : '' }}>Ringan
                            </option>
                            <option value="sedang" {{ old('jenis_pelanggaran') == 'sedang' ? 'selected' : '' }}>Sedang
                            </option>
                            <option value="berat" {{ old('jenis_pelanggaran') == 'berat' ? 'selected' : '' }}>Berat
                            </option>
                        </select>
                        @error('jenis_pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Hukuman <span class="text-danger">*</span></label>
                        <input type="text" name="hukuman" class="form-control @error('hukuman') is-invalid @enderror"
                            value="{{ old('hukuman') }}" required>
                        @error('hukuman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Bag.Pengasuhan<span class="text-danger">*</span></label>
                        <select name="pengasuh_id" class="form-control @error('pengasuh_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Pengasuh --</option>
                            @foreach ($pengasuh as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pengasuh_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengasuh_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('data-pelanggaran.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
