@extends('layouts.template')
@section('content')
<div class="container-xxl flex-grow-1  pt-3 pb-0">
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1 mb-2">
            <div class="card">
                 <div class="card-header">
                    <h4 class="card-tittle text-primary">Fuzzy Mamdani</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container pt-1">
        <div class="row">
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Curah Hujan</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">Curah hujan merupakan faktor penting yang mempengaruhi kelangsungan hidup nyamuk Aedes aegypti. Hal ini disebabkan saat musim hujan dapat meningkatkan kelembaban udara dan menambah jumlah tempat perindukan nyamuk. Kondisi ini menyebabkan jentik nyamuk semakin banyak dan potensi menularkan virus dengue semakin meningkat (Sucipto,2011:53). BMKG membagi curah hujan bulanan menjadi empat kategori yaitu rendah (0-100 mm/bulan), sedang (100-300 mm/bulan), tinggi (300-500 mm/bulan) dan sangat tinggi (> 500 mm/bulan). (Supriyati et al., 2018)</p>
                        <img class="img-fluid" src="{{  asset('assets/img/mb-ch.png') }}" alt="">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Rentang Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Rendah</th>
                                    <td> 0 - 100 mm/bulan</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sedang</th>
                                    <td>100 - 300 mm/bulan</td>
                                </tr>
                                <tr>
                                    <th scope="row">TInggi</th>
                                    <td >> 300 mm/bulan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Hari Hujan</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">Perkembang biakan nyamuk  berkaitan dengan Indeks Curah Hujan (ICH) 
                        yang merupakan perkalian curah hujan dan hari hujan (HH) yang dikalikan
                        dengan jumlah hari pada bulan tersebut. Sehingga peran HH berpengaruh
                        terhadap perkembangbiakan nyamuk pada suatu daerah khususnya di Kabupaten
                        Jember. Semakin banyak HH dalam satu bulan maka potensi penyebaran terhadap
                        penyakit DBD akan semakin tinggi (Kementerian Kesehatan RI, 2010).
                        Berdasarkan hasil dari wawancara yang dilakukan pada Dinas Pengairan di
                        Kabupaten Jember, terdapat tiga klasifikasi tingkat HH bulanan yang dijelaskan</p>
                        <img class="img-fluid" src="{{  asset('assets/img/mb-hh.png') }}" alt="">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Rentang Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Rendah</th>
                                    <td> < 10 /bulan</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sedang</th>
                                    <td>10 -15 /bulan</td>
                                </tr>
                                <tr>
                                    <th scope="row">TInggi</th>
                                    <td >> 15/bulan</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Angka Bebas Jentik</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">Apabila ABJ (>95%) diharapkan penularan DBD dapat dicegah atau dikurangi. Pada indikator program Pengendalian Penyakit DBD menyatakan ABJ belum mencapai target (>95%) untuk tahun 2007 sampai dengan Tahun 2009. kejadian DBD yang ditangani pada Tahun 2007 memberikan realisasi sebesar 84%, pada Tahun 2008 memberikan realisasi 82,6%, dan pada Tahun 2009 memberikan realisasi 71,1% (Kementerian Kesehatan RI, 2010).<p>
                        <img class="img-fluid" src="{{  asset('assets/img/mb-abj.png') }}" alt="">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Rentang Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Rendah</th>
                                    <td> < 50 %</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sedang</th>
                                    <td> 50 - 95 %</td>
                                </tr>
                                <tr>
                                    <th scope="row">TInggi</th>
                                    <td >> 95 %</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Suhu</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">Keberhasilan perkembangan nyamuk Aedes aegypti sangat ditentukan oleh tempat perindukan yang bergantung pada temperatur. Pada saat suhu udara rendah maka berpengaruh pada perkembangan jentik. Hal tersebut dikarenakan nyamuk merupakan salah satu hewan yang berdarah dingin sehingga proses metabolisme dan siklus kehidupannya tergantung pada suhu lingkungan di sekitarnya. Suhu optimum untuk perkembangan nyamuk adalah 25°C - 27°C. Pada saat terjadi kenaikan suhu, maka dapat memperpendek masa harapan hidup nyamuk dan mengganggu perkembangan patogen dalam tubuhnya (Sucipto, 2011:54). Pertumbuhan nyamuk akan terhenti sama sekali bila suhu kurang dari 10°C atau lebih dari 40°C. (Maghfiroh, 2022).</p>
                        <img class="img-fluid" src="{{  asset('assets/img/mb-suhu.png') }}" alt="">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Rentang Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Rendah</th>
                                    <td> < 10 ℃</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sedang</th>
                                    <td> 20 ℃ - 40 ℃</td>
                                </tr>
                                <tr>
                                    <th scope="row">TInggi</th>
                                    <td >> 40 ℃</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Kelembaban</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">Kelembaban merupakan salah satu faktor yang berpengaruh terhadap kejadian penyakit ini. Kondisi demikian sangat disukai oleh nyamuk Aedes aegyti. Kelembaban dalam rumah juga sangat dipengaruhi oleh pengaruh musim. Menurut Sucipto (2011:54) kebutuhan kelembaban yang tinggi mempengaruhi nyamuk untuk mencari tempat lembab dan basah sebagai tempat perindukan. Pada kelembaban udara kurang dari 60% umur nyamuk tidak bertahan lama. Apabila kelembaban udara lebih dari 60% maka umur nyamuk Ae. Aegypty menjadi panjang serta potensial untuk berkembang biak menjadi vektor penyakit (Kesehatan et al., n.d., 2020)</p>
                        <img class="img-fluid" src="{{  asset('assets/img/mb-kelembaban.png') }}" alt="">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Rentang Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Rendah</th>
                                    <td> < 30 %</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sedang</th>
                                    <td> 30 % -  55 %</td>
                                </tr>
                                <tr>
                                    <th scope="row">TInggi</th>
                                    <td > > 60 % </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Kelembaban</h5>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="text-break" style="text-align:justify;">
                        Rule Yang Digunakan Dalam Penelitian
                        </p>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Rule</th>
                                    <th>Curah Hujan</th>
                                    <th>Hari Hujan</th>
                                    <th>ABJ</th>
                                    <th>Suhu</th>
                                    <th>Kelembaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rule as $item)
                                <tr>
                                    <td>R{{ $loop->iteration }}</td>
                                    <td>{{ $item->ch }}</td>
                                    <td>{{ $item->hh }}</td>
                                    <td>{{ $item->abj }}</td>
                                    <td>{{ $item->suhu }}</td>
                                    <td>{{ $item->kelembaban }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('extraJS')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js">
</script>
<script>
    new Chart(document.getElementById("lineChart"), {
                    type: 'line',
                    data: {
                        labels: [0,100,200],
                        datasets: [{
                            data: [0,1,0],
                            label: "Rendah",
                            borderColor: "rgb(255, 73, 42)",
                            backgroundColor: ' rgba(255, 0, 0, 0.3)',
                            fill: true
                        },
                        {
                            data: [0,1,0],
                            label: "Rendah",
                            borderColor: "rgb(255, 73, 42)",
                            backgroundColor: ' rgba(255, 0, 0, 0.3)',
                            fill: true
                        },
                        ]
                    },
                    options: {
                        scales: {
                                    y: {
                                        // type: 'linear' as const, // magic
                                        ticks: {
                                            precision: 0,
                                            stepSize: 1,
                                        },
                                    },
                                },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: "end",
                                labels: {
                                    padding: 20
                                },
                            }
                            }
                        }
                    });
</script>
@endpush
