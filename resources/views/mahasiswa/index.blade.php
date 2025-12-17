@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-fill"></i> Daftar Mahasiswa</h2>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswas->firstItem() + $index }}</td>
                            <td>
                                @if($mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/50" alt="No Photo" class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
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
                            <td colspan="6" class="text-center">Tidak ada data mahasiswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
@endsection
