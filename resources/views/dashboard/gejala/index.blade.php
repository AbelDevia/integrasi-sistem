@extends('dashboard.layouts.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary">Data Gejala</h5>
                            <a href="{{ route('gejala.create') }}" class="btn btn-primary btn-sm">Tambah Gejala</a>
                        </div>

                        <div class="card-body">
                            <table id="gejalaTable" class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Deskripsi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($gejala as $key => $gejala)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $gejala->kode }}</td>
                                            <td>{{ $gejala->deskripsi }}</td>
                                            <td>
                                                <a href="{{ route('gejala.edit', $gejala->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('gejala.destroy', $gejala->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection
