@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-primary">Data Basis Pengetahuan</h5>
                                <a href="{{ route('basis_pengetahuan.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                           
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
