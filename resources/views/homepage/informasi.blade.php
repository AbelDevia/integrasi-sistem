@extends('homepage.layouts.app')
@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">Home</a> / Informasi</span>
                    <h3>Informasi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="properties section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a href="disease-details.html"><img class="fixed-size" src="{{ asset('assets/images/kudis.jpeg') }}"
                                alt="Penyakit Kudis"></a>
                        <span class="category">Penyakit Kudis</span>
                        {{-- <h6>Penyebab: Tungau</h6> --}}
                        <h4><a href="#">Kudis pada Kambing</a></h4>
                        <ul>
                            <li>Deskripsi: <span>Kudis pada kambing adalah penyakit kulit menular akibat tungau, ditandai
                                    gatal dan kerontokan bulu.</span></li>
                            <li>Pencegahan: <span>Menjaga kebersihan kandang dan lingkungan.</span></li>
                        </ul>
                        <div class="main-button">
                            {{-- <a href="disease-details.html">Pelajari Lebih Lanjut</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a href="#"><img class="fixed-size" src="{{ asset('assets/images/cacingan.jpeg') }}"
                                alt="Penyakit Cacingan"></a>
                        <span class="category">Penyakit Cacingan</span>
                        {{-- <h6>Penyebab: Infeksi Parasit</h6> --}}
                        <h4><a href="disease-details.html">Cacingan pada Kambing</a></h4>
                        <ul>
                            <li>Deskripsi: <span>Cacingan pada kambing adalah infeksi parasit yang menyebabkan lesu, diare,
                                    dan penurunan berat badan.</span></li>
                            <li>Pencegahan: <span>Pemberian obat cacing secara rutin dan menjaga kebersihan kandang.</span>
                            </li>
                        </ul>
                        <div class="main-button">
                            {{-- <a href="disease-details.html">Pelajari Lebih Lanjut</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a href="disease-details.html"><img class="fixed-size"
                                src="{{ asset('assets/images/kembung.jpeg') }}" alt="Penyakit Kembung"></a>
                        <span class="category">Penyakit Kembung</span>
                        {{-- <h6>Penyebab: Pembentukan Gas</h6> --}}
                        <h4><a href="#">Kembung pada Kambing</a></h4>
                        <ul>
                            <li>Deskripsi: <span>Kembung disebabkan oleh pembentukan gas yang lebih cepat dan kegagalan
                                    pengeluaran gas secara normal.</span></li>
                            <li>Pencegahan: <span>Memastikan pola makan yang seimbang dan perawatan rutin.</span></li>
                        </ul>
                        <div class="main-button">
                            {{-- <a href="disease-details.html">Pelajari Lebih Lanjut</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
