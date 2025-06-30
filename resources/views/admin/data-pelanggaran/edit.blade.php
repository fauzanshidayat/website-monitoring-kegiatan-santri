@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Data Pelanggaran</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('data-pelanggaran.update', $dataPelanggaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Pelanggaran <span class="text-danger">*</span></label>
                        <input type="text" name="pelanggaran"
                            class="form-control @error('pelanggaran') is-invalid @enderror"
                            value="{{ old('pelanggaran', $dataPelanggaran->pelanggaran) }}" required>
                        @error('pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Pelanggaran <span class="text-danger">*</span></label>
                        <select name="jenis_pelanggaran"
                            class="form-control @error('jenis_pelanggaran') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Pelanggaran --</option>
                            <option value="ringan"
                                {{ old('jenis_pelanggaran', $dataPelanggaran->jenis_pelanggaran) == 'ringan' ? 'selected' : '' }}>
                                Ringan</option>
                            <option value="sedang"
                                {{ old('jenis_pelanggaran', $dataPelanggaran->jenis_pelanggaran) == 'sedang' ? 'selected' : '' }}>
                                Sedang</option>
                            <option value="berat"
                                {{ old('jenis_pelanggaran', $dataPelanggaran->jenis_pelanggaran) == 'berat' ? 'selected' : '' }}>
                                Berat</option>
                        </select>
                        @error('jenis_pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Hukuman <span class="text-danger">*</span></label>
                        <input type="text" name="hukuman" class="form-control @error('hukuman') is-invalid @enderror"
                            value="{{ old('hukuman', $dataPelanggaran->hukuman) }}" required>
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
                                    {{ old('pengasuh_id', $dataPelanggaran->pengasuh_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengasuh_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('data-pelanggaran.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
