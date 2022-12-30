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
                            <h5 class="card-title text-primary">Tambah Data Vektor </h5>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <form action="{{ route('vektor.store') }}" method="POST">
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
                                        <small class="mt-1 text-primary">Format : yyyy</small>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <small class="text-uppercase fw-semibold d-block">Triwulan<span class="text-danger">
                                            *</span></small>
                                    <div class="input-group input-group-merge ">
                                        <div class="input-group">
                                            <select id="triwulan" name="triwulan"
                                                class="select2 form-select  @error('triwulan') is-invalid @enderror">
                                                <option value="">--- Pilih triwulan ---</option>
                                                @foreach ($triwulan as $key => $value )
                                                @if ( old('triwulan') == $key)
                                                <option value="{{ $key }}" selected>{{ $value['name']
                                                    }}
                                                </option>
                                                @else
                                                <option value="{{ $key }}">{{ $value['name'] }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('tahun')
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
                                        @if ( old('kecamatan') == $item->id)
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
                                    <label class="form-label" for="rumah_diperiksa">Jumlah Rumah Diperiksa<span
                                            id="required">*</span></label>
                                    <input type="number"
                                        class="form-control  @error('rumah_diperiksa') is-invalid @enderror"
                                        name="rumah_diperiksa" id="rumah_diperiksa" value="{{ old('rumah_diperiksa') }}"
                                        placeholder="Masukkan Rata-rata Temperatur" min="0">
                                    @error('rumah_diperiksa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="rumah_positif">Jumlah Rumah Positif Jentik<span
                                            id="required">*</span></label>
                                    <input type="number" step="0.01"
                                        class="form-control  @error('rumah_positif') is-invalid @enderror"
                                        name="rumah_positif" id="rumah_positif" value="{{ old('rumah_positif') }}"
                                        placeholder="Masukkan Rata-rata Temperatur" min="0" onchange="">
                                    @error('rumah_positif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="hi">House Index <small>(%)</small> </label>
                                    <input type="number" step="0.01"
                                        class="form-control  @error('hi') is-invalid @enderror" name="hi" id='hi'
                                        value="{{ old('hi') }}" placeholder="House Index" min="0" readonly>
                                    @error('hi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="abj">Angka Bebas Jentik <small>(%)</small> </label>
                                    <input type="number" step="0.01"
                                        class="form-control  @error('abj') is-invalid @enderror" name="abj" id="abj"
                                        value="{{ old('abj') }}" placeholder="Angka Bebas Jentik" min="0" readonly>
                                    @error('abj')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label class="form-label" for="kasus_dbd">Kasus DBD</label>
                                    <span id="required">*</span>
                                    <input type="number" step="0.01" class="form-control step=" 0.01"
                                        @error('kasus_dbd') is-invalid @enderror" name="kasus_dbd"
                                        value="{{ old('kasus_dbd') }}" placeholder="Masukkan jumlah Kasus DBD" min="0">
                                    @error('kasus_dbd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a class="btn btn-outline-secondary" href="{{ route('klimatologi.index') }}">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('extraJS')
<script>
    $(document).ready(function() {
        $("#rumah_positif, #rumah_diperiksa").keyup(function() {
            var rumah_positif = $('#rumah_positif').val()  != null ?   $('#rumah_positif').val() : 0 ;
            var jumlah_diperiksa = $('#rumah_diperiksa').val() != null ?   $('#rumah_diperiksa').val() : 0 ;

            var total_hi = (rumah_positif / jumlah_diperiksa) * 100;
            var total_abj =  (jumlah_diperiksa - rumah_positif) / jumlah_diperiksa * 100 ;

            $("#hi").val(total_hi);
            $("#abj").val(total_abj);

        });
    });
</script>
@if (session('success'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: "{{ session()->get('success') }}",
            type: "success"
        }).then(function (result) {
    if (result.value) {
        window.location = "/admin-panel/vektor";
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
        window.location = "/admin-panel/vektor";
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
        format: "yyyy",
        weekStart: 1,
        orientation: "bottom",
        keyboardNavigation: false,
        viewMode: "years",
        minViewMode: "years"
	});
    $('.fa-calendar').click(function() {
        $("#datepicker").focus();
    });
</script>
@endpush
