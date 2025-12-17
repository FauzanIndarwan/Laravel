@extends('layouts.app')

@section('title', 'Daftar Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge-fill"></i> Daftar Dosen</h2>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Dosen
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Bidang Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dosens as $index => $dosen)
                        <tr>
                            <td>{{ $dosens->firstItem() + $index }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nip }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dosen.show', $dosen) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('dosen.destroy', $dosen) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')">
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
                            <td colspan="6" class="text-center">Tidak ada data dosen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $dosens->links() }}
        </div>
    </div>
</div>
@endsection
