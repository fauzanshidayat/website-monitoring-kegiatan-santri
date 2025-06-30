@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Pengajuan Perizinan Pulang</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('perizinan-pulang.update', $perizinan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Alasan Pulang <span class="text-danger">*</span></label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="3" required>{{ old('alasan', $perizinan->alasan) }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pulang <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pulang"
                            class="form-control @error('tanggal_pulang') is-invalid @enderror"
                            value="{{ old('tanggal_pulang', $perizinan->tanggal_pulang) }}" required>
                        @error('tanggal_pulang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali"
                            class="form-control @error('tanggal_kembali') is-invalid @enderror"
                            value="{{ old('tanggal_kembali', $perizinan->tanggal_kembali) }}" required>
                        @error('tanggal_kembali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('perizinan-pulang.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
