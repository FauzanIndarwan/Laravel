@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Detail Proyek</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Judul</th>
                        <td>: {{ $proyek->judul }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: {{ $proyek->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Mahasiswa</th>
                        <td>: {{ $proyek->mahasiswa->nama ?? '-' }} ({{ $proyek->mahasiswa->nim ?? '-' }})</td>
                    </tr>
                    <tr>
                        <th>Dosen Pembimbing</th>
                        <td>: {{ $proyek->dosen->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($proyek->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($proyek->status == 'completed')
                                <span class="badge bg-primary">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dokumen</th>
                        <td>: 
                            @if($proyek->dokumen)
                                <a href="{{ asset('storage/' . $proyek->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-file-earmark-pdf"></i> Lihat Dokumen
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>: {{ $proyek->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Diupdate Pada</th>
                        <td>: {{ $proyek->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('proyek.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('proyek.edit', $proyek) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
