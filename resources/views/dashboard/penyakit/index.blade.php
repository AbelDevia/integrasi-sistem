@extends('dashboard.layouts.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary">Data Penyakit</h5>
                            <a href="{{ route('penyakit.create') }}" class="btn btn-primary btn-sm">Add Penyakit</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Rekomendasi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penyakits as $key => $penyakit)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $penyakit->kode }}</td>
                                            <td>{{ $penyakit->nama }}</td>
                                            <td>{{ $penyakit->deskripsi }}</td>
                                            <td>{{ $penyakit->rekomendasi }}</td>
                                            <td>
                                                <a href="{{ route('penyakit.edit', $penyakit->id) }}" 
                                                   class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('penyakit.destroy', $penyakit->id) }}" 
                                                      method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data available</td>
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
