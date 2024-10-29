@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Basis Pengetahuan</h5>
                        </div>
                        <div class="card-body">
                            <!-- Menampilkan pesan sukses jika ada -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <a href="{{ route('basis_pengetahuan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

                            <table id="basisPengetahuanTable" class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Gejala</th>
                                        <th>Penyakit</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($basisPengetahuans as $key => $bp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $bp->gejala->deskripsi }}</td>
                                            <td>{{ $bp->penyakit->nama }}</td>
                                            <td>
                                                <a href="{{ route('basis_pengetahuan.edit', $bp->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('basis_pengetahuan.destroy', $bp->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
