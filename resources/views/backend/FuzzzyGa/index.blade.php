@extends('layouts.template')
@push('extraCSS')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<style>
    .leaflet-container {
        height: 50vh;
        width: 100%;
    }

    #caption {
        font-size: 0.8em;
        font-weight: bold;
        margin-bottom: 0;
    }

    #caption_nyamuk {
        font-size: 0.8em;
        font-weight: bold;
        margin-bottom: 0;
    }

    .form-label #required {
        font-size: 1em;
        font-weight: bold;
        margin-bottom: 0;
        color: red;
    }

    #required {
        font-size: 1em;
        margin-bottom: 0;
        color: red;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-1">
                    <div class="card-header">
                        <div class="d-flex align-items-start justify-content-between">
                            <h5 class="card-title text-primary">Tambah Genetic Algorithm</h5>
                            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card-body">
                            <form action="{{ route('fuzzyGa.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="temperatur">Crossover Rate<span id="required">
                                                *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control  @error('cr') is-invalid @enderror" name="cr"
                                            value="{{ old('cr') }}" placeholder="Masukkan Crossover Rate" min="0"
                                            max="1">
                                        @error('cr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="temperatur">Mutation Rate<span id="required">
                                                *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control  @error('mr') is-invalid @enderror" name="mr"
                                            value="{{ old('mr') }}" placeholder="Masukkan Mutation Rate" min="0">
                                        @error('mr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="temperatur">Generation Rate<span id="required">
                                                *</span></label>
                                        <input type="number" class="form-control  @error('gen') is-invalid @enderror"
                                            name="gen" value="{{ old('gen') }}" placeholder="Masukkan Jumlah Generation"
                                            min="0">
                                        @error('gen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="temperatur">Population<span id="required">
                                                *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control  @error('population') is-invalid @enderror"
                                            name="population" value="{{ old('population') }}"
                                            placeholder="Masukkan Jumlah population" min="0">
                                        @error('population')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('klimatologi.index') }}">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-start justify-content-between">
                            <h5 class="card-title text-primary">Data Genetic Algorithm</h5>
                            <div>
                                <h6>Generasi yang Terbaik : {{ $fitnessTerbaik->generation }}</h6>
                            </div>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">CR</th>
                                        <th class="text-center">MR</th>
                                        <th class="text-center">GEN</th>
                                        <th class="text-center">Population</th>
                                        <th class="text-center">Generation</th>
                                        <th class="text-center">Fitness</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$data->isEmpty())
                                    @foreach ($data as $item)
                                    <tr>
                                        <td><strong>{{ $item->id}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->cr}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->mr}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->generation_rate}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->population}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->generation}}</strong></td>
                                        <td class="text-center"><strong>{{ $item->fitness}}</strong></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">Data Masih Kosong</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {{ $data->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-1">
                    <div class="card-header">
                        <div class="d-flex align-items-start justify-content-between">
                            <h5 class="card-title text-primary">Uji Ukuran Populasi</h5>

                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-1">
                    <div class="card-header">
                        <div class="d-flex align-items-start justify-content-between">
                            <h5 class="card-title text-primary">Uji Ukuran Generasi</h5>

                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('extraJS')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $.ajax({
        method: 'GET',
        url: '/ujiPopulasi',
        async: true,
        success: function(result) {
            lineChart = new Chart(document.getElementById("lineChart"), {
            type: 'line',
            data: {
                labels: result['population'],
                datasets: [{
                    data: result['fitness'],
                    label: "Fitness",
                    borderColor: "blue",
                    backgroundColor: ' rgba(255, 0, 0, 0.3)',
                    // fill: true
                },
                ]
            },
            options: {
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
    $.ajax({
        method: 'GET',
        url: '/ujiGenerasi',
        async: true,
        success: function(result) {
            lineChart = new Chart(document.getElementById("lineChart2"), {
            type: 'line',
            data: {
                labels: result['generation'],
                datasets: [{
                    data: result['fitness'],
                    label: "Fitness",
                    borderColor: "rgb(255, 73, 42)",
                    backgroundColor: ' rgba(255, 0, 0, 0.3)',
                    // fill: true
                },
                ]
            },
            options: {
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
</script>
@endpush
