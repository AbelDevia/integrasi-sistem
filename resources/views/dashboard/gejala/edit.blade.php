@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Edit Data Gejala</h4>

        <!-- Menampilkan pesan kesalahan validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('gejala.update', $gejala->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT method untuk update -->

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Gejala</label>
                        <input type="text" class="form-control" id="kode" name="kode" value="{{ $gejala->kode }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $gejala->deskripsi }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
