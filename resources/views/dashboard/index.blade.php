@extends('dashboard.layouts.app')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Row for Statistics -->
            <div class="row">
                <!-- Total Penyakit -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Penyakit</h5>
                            <p class="card-text fs-3">{{ $data['total_penyakit'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Gejala -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Gejala</h5>
                            <p class="card-text fs-3">{{ $data['total_gejala'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Basis Pengetahuan -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Basis Pengetahuan</h5>
                            <p class="card-text fs-3">{{ $data['total_basis_pengetahuan'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Kambing -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Kambing</h5>
                            <p class="card-text fs-3">{{ $data['total_kambing'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Kegiatan -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Kegiatan</h5>
                            <p class="card-text fs-3">{{ $data['total_kegiatan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row for Recent Data -->
            <div class="row mt-4">
                <!-- Recent Penyakit -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Penyakit</h5>
                            <ul class="list-group">
                                @foreach ($data['recent_penyakit'] as $penyakit)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $penyakit->kode }}
                                        <span class="text-muted small">{{ $penyakit->nama }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Gejala -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Gejala</h5>
                            <ul class="list-group">
                                @foreach ($data['recent_gejala'] as $gejala)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $gejala->kode }} - {{ $gejala->deskripsi }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Recent Kambing -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Kambing</h5>
                            <ul class="list-group">
                                @foreach ($data['recent_kambing'] as $kambing)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $kambing->kode }} - Umur: {{ $kambing->usia }} Bulan
                                        <span class="text-muted small">{{ $kambing->ras }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Kegiatan -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Kegiatan</h5>
                            <ul class="list-group">
                                @foreach ($data['recent_kegiatan'] as $kegiatan)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $kegiatan->nama }}
                                        <span class="text-muted small">{{ $kegiatan->tanggal }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection
