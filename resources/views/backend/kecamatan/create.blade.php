@extends('layouts.template')
@push('extraCSS')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<style>
    .form-label #required {
        font-size: 1em;
        font-weight: bold;
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
                            <h5 class="card-title text-primary">Tambah Kecamatan</h5>
                        </div>
                        <hr class="my-0" />
                    </div>

                    <div class="card-body">
                        <form action="{{ route('kecamatan.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="kecamatan" class="form-label">Kecamatan <span
                                            id="required">*</span></label>
                                    <input type="text" class="form-control  @error('kecamatan') is-invalid @enderror"
                                        name="kecamatan" value="{{ old('kecamatan') }}"
                                        placeholder="Masukkan Nama Kecamatan">
                                    @error('kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a class="btn btn-outline-secondary" href="{{ route('kecamatan.index') }}">Batal</a>
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
@push('extraJS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js">
</script>
<script type="text/javascript">
    $("#datepicker").datepicker(
		    {viewMode: 'years',
		     format: 'yyyy-mm',
             minViewMode: 1
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
            window.location = "/admin-panel/data-master/kecamatan";
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
            window.location = "/admin-panel/data-master/kecamatan";
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
@endpush
