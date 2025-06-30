@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h4 class="mb-3">Ajukan Perizinan Pulang</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('perizinan-pulang.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Alasan Pulang <span class="text-danger">*</span></label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="3" required>{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pulang <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pulang"
                            class="form-control @error('tanggal_pulang') is-invalid @enderror"
                            value="{{ old('tanggal_pulang') }}" required>
                        @error('tanggal_pulang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali"
                            class="form-control @error('tanggal_kembali') is-invalid @enderror"
                            value="{{ old('tanggal_kembali') }}" required>
                        @error('tanggal_kembali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Ajukan</button>
                        <a href="{{ route('perizinan-pulang.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
