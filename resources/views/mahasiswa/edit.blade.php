@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Edit Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                               id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        @if($mahasiswa->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                               id="foto" name="foto" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">Format: JPG, JPEG, PNG (Max: 1MB). Kosongkan jika tidak ingin mengubah foto.</small>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
