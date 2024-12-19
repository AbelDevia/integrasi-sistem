@extends('homepage.layouts.app')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">Home</a> / Diagnosis</span>
                    <h3>Diagnosis</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="properties section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-success">Pilih Kambing dan Gejala</h4>
                            <div>
                                <button class="btn btn-outline-secondary btn-sm" id="refreshButton">
                                    <i class="fa fa-refresh"></i> Refresh
                                </button>
                                <button class="btn btn-success btn-sm" id="printButton">
                                    <i class="fa fa-print"></i> Cetak PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="diagnosisForm">
                                <p>Pilih kambing yang akan didiagnosis:</p>
                                <div class="mb-3">
                                    <select class="form-select" id="kambingSelect" name="kambing">
                                        <option value="" disabled selected>Pilih Kambing</option>
                                        @foreach ($kambings as $kambing)
                                            <option value="{{ $kambing->id }}">{{ $kambing->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <p>Pilih gejala yang sesuai dengan keadaan kambing:</p>
                                <div class="row mb-3">
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

                                <button type="button" class="btn btn-success" id="calculateButton">Lanjutkan</button>
                            </form>
                        </div>

                        <div id="result" class="mt-4"></div>

                        <!-- Hasil Diagnosis Sebelumnya -->
                        <div class="mt-4">
                            <h5>Hasil Diagnosis Sebelumnya:</h5>
                            @if ($hasil->isEmpty())
                                <p>Tidak ada hasil diagnosis sebelumnya.</p>
                            @else
                                <table class="table table-bordered" id="resultTable">
                                    <thead>
                                        <tr>
                                            <th>Penyakit</th>
                                            <th>Kambing</th>
                                            <th>Gejala</th>
                                            <th>Confidence (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil as $item)
                                            <tr>
                                                <td>{{ $item->penyakit->nama }}</td>
                                                <td>{{ $item->kambing->kode }}</td>
                                                <td>{{ implode(', ', json_decode($item->gejala)) }}</td>
                                                <td>{{ $item->confidence }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tombol Cetak PDF
        document.getElementById('printButton').addEventListener('click', function() {
            const resultContent = document.getElementById('result').innerHTML || document.getElementById(
                'resultTable').outerHTML;

            if (!resultContent.trim()) {
                alert('Tidak ada hasil untuk dicetak.');
                return;
            }

            const newWindow = window.open('', '_blank');
            newWindow.document.write(`
                <html>
                <head>
                    <title>Hasil Diagnosis</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        table, th, td { border: 1px solid #ccc; text-align: left; padding: 8px; }
                        th { background-color: #f4f4f4; }
                        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
                    </style>
                </head>
                <body>
                    <div class="title">Hasil Diagnosis</div>
                    ${resultContent}
                </body>
                </html>
            `);
            newWindow.document.close();
            newWindow.print();
        });

        // Tombol Lanjutkan (Perhitungan)
        document.getElementById('calculateButton').addEventListener('click', function() {
            const kambing = document.getElementById('kambingSelect').value;
            const gejala = Array.from(document.querySelectorAll('input[name="gejala[]"]:checked')).map(cb => cb
                .value);

            if (!kambing) {
                alert('Pilih kambing yang akan didiagnosis.');
                return;
            }

            if (gejala.length === 0) {
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
                        kambing,
                        gejala
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('result');
                    if (data.success) {
                        let resultHTML = '<h5>Hasil Diagnosis:</h5><div class="row">';
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

        // Tombol Refresh
        document.getElementById('refreshButton').addEventListener('click', function() {
            window.location.reload();
        });
    </script>
@endsection
