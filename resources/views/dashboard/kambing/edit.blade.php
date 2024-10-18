@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">Edit Data Kambing</h4>

        <!-- Tampilkan pesan error jika ada -->
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
                <form action="{{ route('kambing.update', $kambings->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Metode PUT untuk update data -->

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control"
                            value="{{ $kambings->kode }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="Jantan" {{ $kambings->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan
                            </option>
                            <option value="Betina" {{ $kambings->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="usia" class="form-label">Usia (bulan)</label>
                        <input type="number" name="usia" id="usia" class="form-control"
                            value="{{ $kambings->usia }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ras" class="form-label">Ras</label>
                        <input type="text" name="ras" id="ras" class="form-control"
                            value="{{ $kambings->ras }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('kambing.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
