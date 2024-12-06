@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary">Pilih Gejala</h5>
                        </div>
                        <div class="card-body">
                            <form id="forwardChainingForm">
                                <p class="mb-3">Pilih gejala yang sesuai dengan keadaan kambing:</p>
                                <div class="row">
                                    @foreach ($gejalas as $gejala)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="gejala[]"
                                                    value="{{ $gejala->id }}" id="gejala-{{ $gejala->id }}">
                                                <label class="form-check-label" for="gejala-{{ $gejala->id }}">
                                                    {{ $gejala->deskripsi }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary" id="calculateButton">Lanjutkan</button>
                                </div>
                            </form>
                        </div>
                        <div id="result" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('calculateButton').addEventListener('click', function() {
            const selectedGejala = Array.from(document.querySelectorAll('input[name="gejala[]"]:checked')).map(cb =>
                cb.value);

            if (selectedGejala.length === 0) {
                alert('Pilih minimal satu gejala.');
                return;
            }

            fetch("{{ route('api.proses.calculate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        gejala: selectedGejala
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('result');
                    if (data.success) {
                        let resultHTML = '<h5>Hasil Diagnosis:</h5>';
                        resultHTML += '<div class="row">';
                        data.data.forEach(item => {
                            resultHTML += `
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">${item.penyakit}</h6>
                                            <p class="card-text">Confidence: ${item.confidence}%</p>
                                            <p class="card-text">Matched: ${item.matched} dari ${item.total}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        resultHTML += '</div>';
                        resultDiv.innerHTML = resultHTML;
                    } else {
                        resultDiv.innerHTML = '<p class="text-danger">Terjadi kesalahan dalam perhitungan.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
