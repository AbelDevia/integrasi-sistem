@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Data Kegiatan</h5>
                    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary btn-sm">Tambah Kegiatan</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatans as $key => $kegiatan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kegiatan->deskripsi }}</td>
                                    <td>{{ $kegiatan->tanggal }}</td>
                                    <td>{{ ucfirst($kegiatan->status) }}</td>
                                    <td>
                                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada kegiatan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
