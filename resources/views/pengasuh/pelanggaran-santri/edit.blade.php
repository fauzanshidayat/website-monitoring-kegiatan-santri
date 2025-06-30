@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h3 class="page-title text-dark font-weight-medium mb-1">Edit Pelanggaran - {{ $dataPelanggaran->pelanggaran }}</h3>

        <h5 class="mb-3">Informasi Pelanggaran:</h5>
        <ul>
            <li><strong>Jenis Pelanggaran:</strong> {{ ucfirst($dataPelanggaran->jenis_pelanggaran) }}</li>
            <li><strong>Hukuman:</strong> {{ $dataPelanggaran->hukuman }}</li>
            <li><strong>Pengasuh:</strong> {{ $dataPelanggaran->pengasuh->nama_lengkap ?? '-' }}</li>
        </ul>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengasuh.pelanggaran.update', $pelanggaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="data_pelanggaran_id" value="{{ $dataPelanggaran->id }}">

                    <div class="form-group">
                        <label>Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" class="form-control @error('santri_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santri as $s)
                                <option value="{{ $s->id }}"
                                    {{ old('santri_id', $pelanggaran->santri_id) == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('santri_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $pelanggaran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Melanggar <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_melanggar"
                            class="form-control @error('tanggal_melanggar') is-invalid @enderror"
                            value="{{ old('tanggal_melanggar', \Carbon\Carbon::parse($pelanggaran->tanggal_melanggar)->format('Y-m-d')) }}"
                            required>
                        @error('tanggal_melanggar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('pengasuh.pelanggaran.show', $dataPelanggaran->id) }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
