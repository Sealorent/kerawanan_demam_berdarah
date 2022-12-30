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
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-start justify-content-between">
                            <h5 class="card-title text-primary">Tambah Data Klimatologi </h5>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <form action="{{ route('klimatologi.store') }}" method="POST">
                            <div class="mb-2">
                                <small class="text-danger">*</small>
                                <small style="font-weight: bold">Wajib Diisi</small>
                            </div>
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-md-4">
                                    <small class="text-uppercase fw-semibold d-block">Tahun<span class="text-danger">
                                            *</span></small>
                                    <div class="input-group input-group-merge ">
                                        <div class="input-group">
                                            <input type="text" id="datepicker"
                                                class="form-control  @error('tahun') is-invalid @enderror" name="tahun"
                                                value="{{ old('tahun',date('Y')) }}" placeholder="Tahun Data Demografi"
                                                required />
                                            @error('tahun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <span class="input-group-text" id="text-to-speech-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <small class="text-uppercase fw-semibold d-block">Triwulan<span class="text-danger">
                                            *</span></small>
                                    <div class="input-group input-group-merge ">
                                        @php
                                        $triwulan = array(
                                        1 => "Triwulan 1",
                                        2 => "Triwulan 2",
                                        3 => "Triwulan 3",
                                        4 => "Triwulan 4"
                                        );

                                        @endphp
                                        <div class="input-group">
                                            <select id="triwulan" name="triwulan"
                                                class="select2 form-select  @error('triwulan') is-invalid @enderror">
                                                <option value="">--- Pilih triwulan ---</option>
                                                @foreach ($triwulan as $key => $value )
                                                @if ( old('triwulan') == $key)
                                                <option value="{{ $key }}" selected>{{ $value
                                                    }}
                                                </option>
                                                @else
                                                <option value="{{ $key }}">{{ $value }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('triwulan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-md-12">
                                    <label class="form-label" for="kecamatan">Kecamatan <span
                                            id="required">*</span></label>
                                    <select id="kecamatan" name="kecamatan"
                                        class="select2 form-select  @error('kecamatan') is-invalid @enderror">
                                        <option value="">--- Pilih Kecamatan ---</option>
                                        @foreach ($kecamatan as $item )
                                        @if (old('kecamatan') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->nama_kecamatan
                                            }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="temperatur">Temperatur <small>(°C)</small> <span
                                            id="required">*</span></label>
                                    <input type="number" step="0.01"
                                        class="form-control  @error('temperatur') is-invalid @enderror"
                                        name="temperatur" value="{{ old('temperatur') }}"
                                        placeholder="Masukkan Rata-rata Temperatur" min="0">
                                    @error('temperatur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="kelembaban">Kelembaban <small>(%)</small> <span
                                            id="required">*</span></label>
                                    <input type="number" step="0.01"
                                        class="form-control  @error('kelembaban') is-invalid @enderror"
                                        name="kelembaban" value="{{ old('kelembaban') }}"
                                        placeholder="Masukkan Rata-rata Kelembaban" min="0">
                                    @error('kelembaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="curah_hujan">Curah Hujan</label>
                                    <small>(mm)</small>
                                    <span id="required">*</span>
                                    <input type="number" step="0.01" class="form-control step=" 0.01"
                                        @error('curah_hujan') is-invalid @enderror" name="curah_hujan"
                                        value="{{ old('curah_hujan') }}" placeholder="Masukkan Rata-rata Curah Hujan"
                                        min="0">
                                    @error('curah_hujan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="curah_hujan">Hari Hujan</label>
                                    <small>(mm)</small>
                                    <span id="required">*</span>
                                    <input type="number" step="0.01" class="form-control step=" 0.01"
                                        @error('hari_hujan') is-invalid @enderror" name="hari_hujan"
                                        value="{{ old('hari_hujan') }}" placeholder="Masukkan Rata-rata Hari Hujan"
                                        min="0">
                                    @error('hari_hujan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-12" id="caption">
                                    <p class="text-warning">Ket: Masukkan Rata-Rata Temperatur, Kelembaban, dan Curah
                                        Hujan</p>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a class="btn btn-outline-secondary" href="{{ route('klimatologi.index') }}">Batal</a>
                            </div>
                        </form>
                        {{-- <div id="map"></div> --}}

                    </div>

                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Set Year Javascript --}}
@push('extraJS')
@if (session('success'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: "{{ session()->get('success') }}",
            type: "success"
        }).then(function (result) {
    if (result.value) {
        window.location = "/admin-panel/klimatologi";
    }
    })
</script>
@endif
@if (session('info'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Mohon Maaf',
        text: '{{ session()->get('info') }}',
    }).then(function (result) {
    if (result.value) {
        window.location = "/admin-panel/klimatologi";
    }
    })
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: '{{ session()->get('error') }}',
    })
</script>
@endif
<script type="text/javascript">
    $("#datepicker").datepicker(
    {
        viewMode: 'years',
        format: 'yyyy',
        minViewMode: "years",
        zIndexOffset : 999,
        orientation: "bottom",
        autoclose: true,
	});
    $('.fa-calendar').click(function() {
        $("#datepicker").focus();
    });
</script>
@endpush
