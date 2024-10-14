@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Edit Data Penyakit</h4>

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
                <form action="{{ route('penyakit.update', $penyakit->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT method untuk update -->

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Penyakit</label>
                        <input type="text" class="form-control" id="kode" name="kode"
                            value="{{ $penyakit->kode }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Penyakit</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $penyakit->nama }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $penyakit->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rekomendasi" class="form-label">Rekomendasi</label>
                        <textarea class="form-control" id="rekomendasi" name="rekomendasi" rows="4" required>{{ $penyakit->rekomendasi }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('penyakit.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
