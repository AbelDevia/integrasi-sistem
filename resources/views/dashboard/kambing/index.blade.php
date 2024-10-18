@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3">Data Kambing</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-primary">Daftar Kambing</h5>
                    <a href="{{ route('kambing.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>

                <div class="card-body">
                    <table id="kambingTable" class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia (bulan)</th>
                                <th>Ras</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kambings as $key => $kambing)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kambing->kode }}</td>
                                    <td>{{ $kambing->jenis_kelamin }}</td>
                                    <td>{{ $kambing->usia }}</td>
                                    <td>{{ $kambing->ras }}</td>
                                    <td>
                                        <a href="{{ route('kambing.edit', $kambing->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kambing.destroy', $kambing->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
