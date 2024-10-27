@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Kegiatan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" value="{{ $kegiatan->deskripsi }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $kegiatan->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $kegiatan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="selesai" {{ $kegiatan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
