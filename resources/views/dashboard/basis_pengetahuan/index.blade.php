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
                                        <th>Penyakit</th>
                                        <th>Gejala</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $groupedBasisPengetahuan = $basisPengetahuans->groupBy('penyakit.nama');
                                        $rowNumber = 1;
                                    @endphp
                                    @foreach ($groupedBasisPengetahuan as $penyakit => $groupedGejala)
                                        <tr class="group-row">
                                            <td rowspan="{{ count($groupedGejala) }}">{{ $rowNumber++ }}</td>
                                            <td rowspan="{{ count($groupedGejala) }}">{{ $penyakit }}</td>
                                            <td>{{ $groupedGejala[0]->gejala->deskripsi }}</td>
                                            <td>
                                                <a href="{{ route('basis_pengetahuan.edit', $groupedGejala[0]->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <form
                                                    action="{{ route('basis_pengetahuan.destroy', $groupedGejala[0]->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @foreach ($groupedGejala->slice(1) as $bp)
                                            <tr>
                                                <td>{{ $bp->gejala->deskripsi }}</td>
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
                                        <tr class="group-separator">
                                            <td colspan="4"></td>
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

    <style>
        /* Tambahkan gaya CSS untuk garis pembatas */
        .group-separator td {
            border-top: 2px solid #dee2e6;
            /* Garis pemisah antar kelompok */
        }

        .group-row td {
            background-color: #f8f9fa;
            /* Warna latar untuk baris kelompok penyakit */
        }
    </style>
@endsection
