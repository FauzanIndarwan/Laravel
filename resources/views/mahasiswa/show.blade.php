@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Detail Mahasiswa</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-center">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Mahasiswa" class="img-fluid rounded" style="max-width: 250px;">
                        @else
                            <img src="https://via.placeholder.com/250" alt="No Photo" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Nama</th>
                                <td>: {{ $mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>: {{ $mahasiswa->nim }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $mahasiswa->email }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>: {{ $mahasiswa->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diupdate Pada</th>
                                <td>: {{ $mahasiswa->updated_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>

                        @if($mahasiswa->proyek)
                            <div class="alert alert-info mt-3">
                                <strong>Proyek:</strong> {{ $mahasiswa->proyek->judul }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
