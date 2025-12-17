@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-folder-fill"></i> Daftar Proyek</h2>
    <a href="{{ route('proyek.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Proyek
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Mahasiswa</th>
                        <th>Dosen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyeks as $index => $proyek)
                        <tr>
                            <td>{{ $proyeks->firstItem() + $index }}</td>
                            <td>{{ $proyek->judul }}</td>
                            <td>{{ $proyek->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $proyek->dosen->nama ?? '-' }}</td>
                            <td>
                                @if($proyek->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($proyek->status == 'completed')
                                    <span class="badge bg-primary">Completed</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('proyek.show', $proyek) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('proyek.edit', $proyek) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('proyek.destroy', $proyek) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $proyeks->links() }}
        </div>
    </div>
</div>
@endsection
