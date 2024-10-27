@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Basis Pengetahuan</h5>
                        </div>
                        <div class="card-body">
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

                            <form action="{{ route('basis_pengetahuan.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="gejala_id" class="form-label">Gejala</label>
                                    <select name="gejala_id" id="gejala_id" class="form-control" required>
                                        <option value="">Pilih Gejala</option>
                                        @foreach ($gejalas as $gejala)
                                            <option value="{{ $gejala->id }}">{{ $gejala->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="penyakit_id" class="form-label">Penyakit</label>
                                    <select name="penyakit_id" id="penyakit_id" class="form-control" required>
                                        <option value="">Pilih Penyakit</option>
                                        @foreach ($penyakits as $penyakit)
                                            <option value="{{ $penyakit->id }}">{{ $penyakit->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
