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
                            <h5 class="card-title text-primary">Tambah Data Kasus</h5>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kasus.store') }}" method="POST">
                            <div class="mb-3">
                                <small class="text-danger">*</small>
                                <small style="font-weight: bold">Wajib Diisi</small>
                            </div>
                            @csrf
                            <div class="row add-form">
                                <div class="form-group mb-2 col-md-4">
                                    <small class="text-uppercase fw-semibold d-block mb-2">Bulan & Tahun<span
                                            class="text-danger">
                                            *</span></small>
                                    <div class="input-group input-group-merge ">
                                        <div class="input-group">
                                            <input type="text" id="datepicker"
                                                class="form-control  @error('date') is-invalid @enderror" name="date"
                                                value="{{ old('date',date('m-Y')) }}" disabled />
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
                                <div class="form-group  col-md-5">
                                    <label class="form-label" for="kecamatan">Kecamatan <span
                                            id="required">*</span></label>
                                    <select id="kecamatan" name="kecamatan"
                                        class="select2 form-select  @error('kecamatan') is-invalid @enderror" disabled>
                                        <option value="">--- Pilih Kecamatan ---</option>
                                        @foreach ($kecamatan as $item )
                                        @if (old('kecamatan') or $kasus->id_kecamatan == $item->id)
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
                                <div class="form-group mb-3 col-md-3">
                                    <label class="form-label" for="temperatur">Total Kasus<span
                                            id="required">*</span></label>
                                    <input type="text"
                                        class="form-control total_kasus @error('total_kasus') is-invalid @enderror"
                                        name="total_kasus" id="total_kasus"
                                        value="{{ old('total_kasus', $kasus->total_kasus) }}"
                                        placeholder="Masukkan total kasus" disabled>
                                    @error('total_kasus')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <input type="text" id="lastId" value="{{ $lastId }}" hidden>
                                @foreach ($detailKasus as $item)
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        {{-- <input type="text" name="id[]" value="{{ $item->id }}"> --}}
                                        <label class="form-label" for="temperatur">Nama Penderita<span
                                                id="required">*</span></label>
                                        <input type="text" class="form-control  @error('nama[]') is-invalid @enderror"
                                            name="nama[]" value="{{ $item->nama_penderita }}"
                                            placeholder="Masukkan nama" disabled>
                                        @error('nama[]')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="temperatur">Longitude <span
                                                id="required">*</span></label>
                                        <input type="number"
                                            class="form-control  @error('longitude[]') is-invalid @enderror"
                                            name="longitude[]" value="{{ $item->longitude }}"
                                            placeholder="Masukkan nilai Longitude" disabled>
                                        @error('longitude[]')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label" for="kelembaban">Latitude <span
                                                id="required">*</span></label>
                                        <input type="number"
                                            class="form-control  @error('latitude[]') is-invalid @enderror"
                                            name="latitude[]" value="{{ $item->latitude }}"
                                            placeholder="Masukkan nilai Latitude" disabled>
                                        @error('latitude[]')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-5">
                                <a class="btn btn-outline-secondary" href="{{ route('kasus.index') }}">Kembali</a>
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
<script type="text/javascript">
    $(document).ready(function() {
    var html = $(".copy").html();



      $(".add-more").click(function(){
          $(".add-form").after(html);
      });

      // saat tombol remove dklik control group akan dihapus
      $("body").on("click",".remove",function(){
            var sum = $('.total_kasus').val() - 1;
            $('.total_kasus').val(sum) ;
          $(this).parents(".control-group").remove();
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
        window.location = "/admin-panel/data-master/kasus";
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
        window.location = "/admin-panel/data-master/kasus";
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
    $('#datepicker').datepicker({
            autoclose: true,
            viewMode: 'yyyy-mm',
            format: 'yyyy-mm',
            minViewMode: 1,
            zIndexOffset : 99999999,
            orientation: "bottom",
    });
    $('.fa-calendar').click(function() {
        $("#datepicker").focus();
    });
</script>
@endpush
