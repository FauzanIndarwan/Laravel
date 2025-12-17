@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Detail Dosen</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama</th>
                        <td>: {{ $dosen->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>: {{ $dosen->nip }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $dosen->email }}</td>
                    </tr>
                    <tr>
                        <th>Bidang Keahlian</th>
                        <td>: {{ $dosen->bidang_keahlian }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>: {{ $dosen->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Diupdate Pada</th>
                        <td>: {{ $dosen->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                @if($dosen->proyeks->count() > 0)
                    <div class="mt-4">
                        <h5>Proyek yang Dibimbing:</h5>
                        <ul class="list-group">
                            @foreach($dosen->proyeks as $proyek)
                                <li class="list-group-item">
                                    <strong>{{ $proyek->judul }}</strong><br>
                                    <small class="text-muted">Status: {{ $proyek->status }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
