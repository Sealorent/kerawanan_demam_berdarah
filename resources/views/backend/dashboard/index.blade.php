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
                        <div class="d-flex align-items-start justify-content-between">
                            <h5>Data Kasus Demam Berdarah</h5>
                            <div class="input-group input-group-merge w-25">
                                <div class="input-group">
                                    <input type="text" id="date_kasus" class="datepicker form-control" name="date_kasus"
                                        value="{{ old('date_kasus',date('Y')-2) }}" placeholder="Tahun Data Demografi">
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="fa fa-calendar date_kasus_icon"></i>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                        <div class="text-center emptyLineChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Data Potensi Demam Berdarah</h5>
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="input-group input-group-merge w-50">
                                    <div class="input-group">
                                        <input type="text" id="date_kasus_pie" class="datepickerpie form-control"
                                            name="date_kasus_pie"
                                            value="{{ old('date_kasus',date('Y',strtotime('-2 year'))) }}"
                                            placeholder="Tahun Data Demografi">
                                        <span class="input-group-text" id="text-to-speech-addon">
                                            <i class="fa fa-calendar date_kasus_icon_pie"></i>
                                        </span>
                                    </div>
                                </div>
                                <select class="form-select" aria-label="Default select example"
                                    aria-placeholder="Pilih Triwulan" class="w-50" id="triwulan">
                                    <option value="1">Triwulan 1</option>
                                    <option value="2">Triwulan 2</option>
                                    <option value="3">Triwulan 3</option>
                                    <option value="4">Triwulan 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart"></canvas>
                        <div class="text-center emptyPieChart" hidden>
                            <p>Data Tahun Ini Tidak ada</p>
                        </div>
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
    $(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years",
            changeYear: true,
            orientation: "bottom",
        });
        $(".datepickerpie").datepicker(
    {
        viewMode: 'years',
        format: 'yyyy',
        minViewMode: "years",
        zIndexOffset : 999,
        orientation: "bottom",
        autoclose: true,
	});
        
        $('.date_kasus_icon').click(function(){
            $("[name='date_kasus']").focus();
        });
        $('.date_kasus_icon_pie').click(function(){
            $("[name='date_kasus_pie']").focus();
        })
    });
    $(document).ready(function() {
        var valdate = $("#date_kasus").val();
        var valdatepieChart = $("#date_kasus_pie").val();
        var triwulanChart = $("#triwulan :selected").val();
        ajaxGetDateLineChart(valdate);
        ajaxGetDatePieChart(valdatepieChart,triwulanChart);
    })

    $('#date_kasus').change(function(){
        var valdate = $("#date_kasus").val();
        ajaxGetDateLineChart(valdate);
    })
    $('#date_kasus_pie').change(function(){
        var valdate = $("#date_kasus_pie").val();
        var triwulanChart = $("#triwulan :selected").val();
        ajaxGetDatePieChart(valdate, triwulanChart);
    })
    $('#triwulan').change(function(){
        var valdate = $("#date_kasus_pie").val();
        var triwulanChart = $("#triwulan :selected").val();
        ajaxGetDatePieChart(valdate, triwulanChart);
    })
    var lineChart = null;
    function ajaxGetDateLineChart(params) {
        $.ajaxSetup ({
            cache:   false
        });
        $.ajax({
                method: 'GET',
                url: '/get-kasus',
                data: {
                    tahun: params,
                },
                async: true,
                success: function(result) {
                    if(result == 'empty'){
                        $('#lineChart').attr('hidden', true);
                        $('.emptyLineChart').attr('hidden', false);
                    }else{
                        $('#lineChart').attr('hidden', false);
                        $('.emptyLineChart').attr('hidden', true);
                    }

                    if(lineChart !== null) {
                        lineChart.destroy();
                    }
                    lineChart = new Chart(document.getElementById("lineChart"), {
                    type: 'line',
                    data: {
                        labels: result['bulan'],
                        datasets: [{
                            data: result['jumlah_kasus'],
                            label: "Kasus Teridentifikasi",
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
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
        });
    }
    var pieChart = null;
    function ajaxGetDatePieChart(tahun, triwulan) {
        $.ajaxSetup ({
            cache:   false
        });
        $.ajax({
                method: 'GET',
                url: '/getAllPotensi',
                data: {
                    tahun: tahun,
                    triwulan: triwulan,
                },
                async: true,
                success: function(result) {
                    console.log(result);
                    if(result == 'empty'){
                        $('#pieChart').attr('hidden', true);
                        $('.emptyPieChart').attr('hidden', false);
                    }else{
                        $('#pieChart').attr('hidden', false);
                        $('.emptyPieChart').attr('hidden', true);
                    }

                    if(pieChart !== null) {
                        pieChart.destroy();
                    }
                    pieChart =  new Chart(document.getElementById('pieChart'), {
                        type: 'pie',
                        data: {
                        labels: result['potensi'],
                        datasets: [{
                            // label: '# of Votes',
                            data: result['jumlah'],
                            borderWidth: 1
                        }]
                        },
                        options: {
                            scales: {
                                    y: {
                                        ticks: {
                                            precision: 0,
                                            stepSize: 1,
                                        },
                                    },
                                },
                        }
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
        });
    }

</script>
@endpush
