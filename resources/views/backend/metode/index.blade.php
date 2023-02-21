@extends('layouts.template')
@section('content')
<div class="container-xxl flex-grow-1  pt-3 pb-0">
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-3 col-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <h1 class="mb-0">{{ App\Models\Kecamatan::count() }}</h1>
                            </div>
                            <span>Jumlah Kecamatan</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <h1 class="mb-0">{{ App\Models\Kasus::sum('total_kasus') }}</h1>
                            </div>
                            <span>Total Kasus</span>
                            {{-- @php
                            $jumlahThisMonth = \App\Models\Periksa::whereMonth('tgl_periksa', date('m'))->count();
                            @endphp
                            <h3 class="card-title text-nowrap mb-1">{{ $jumlahThisMonth }}</h3> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-md-6 col-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success"
                                        class="rounded" />
                                </div>

                                <h4 class="mb-0">{{ App\Models\paramGa::orderBy('fitness',
                                    'desc')->first()->generation}}</h4>
                            </div>
                            <span>Generasi Terbaik Algoritma Genetika</span>
                        </div>
                    </div>
                </div> --}}

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
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{  asset('assets/img/mb-ch.png') }}" alt="">
                        <!-- <canvas id="lineChart"></canvas>
                        <div class="text-center emptyLineChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Hari Hujan</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{  asset('assets/img/mb-hh.png') }}" alt="">

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
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Angka Bebas Jentik</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{  asset('assets/img/mb-abj.png') }}" alt="">

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
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Suhu</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{  asset('assets/img/mb-suhu.png') }}" alt="">

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
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Kelembaban</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{  asset('assets/img/mb-kelembaban.png') }}" alt="">

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
