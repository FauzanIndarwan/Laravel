@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tambah Proyek Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" name="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mahasiswa_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                        <select class="form-select @error('mahasiswa_id') is-invalid @enderror" 
                                id="mahasiswa_id" name="mahasiswa_id" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                                </option>
                            @endforeach
                        </select>
                        @error('mahasiswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dosen_id" class="form-label">Dosen Pembimbing <span class="text-danger">*</span></label>
                        <select class="form-select @error('dosen_id') is-invalid @enderror" 
                                id="dosen_id" name="dosen_id" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama }} ({{ $dosen->bidang_keahlian }})
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dokumen" class="form-label">Dokumen <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                               id="dokumen" name="dokumen" accept=".pdf,.docx" required>
                        <small class="text-muted">Format: PDF, DOCX (Max: 2MB)</small>
                        @error('dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('proyek.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
