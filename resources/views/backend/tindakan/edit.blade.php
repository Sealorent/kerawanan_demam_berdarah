@extends('layouts.template')
@push('extraCSS')
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
                            <h5 class="card-title text-primary">Edit Tindakan</h5>
                        </div>
                        <hr class="my-0" />
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tindakan.update',$data->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                            <div class="form-group mb-3 col-md-3">
                                    <label class="form-label" for="kecamatan">Potensi<span id="required">*</span></label>
                                    <select id="potensi" name="potensi" class="select2 form-select  @error('potensi') is-invalid @enderror">
                                        <option value="">--- Pilih Potensi ---</option>
                                        <option value="tinggi" {{ old('potensi',$data->potensi) == 'tinggi' ? 'selected' : '' }} >Tinggi</option>
                                        <option value="sedang" {{ old('potensi',$data->potensi ) == 'sedang' ? 'selected' : '' }} >Sedang</option>
                                        <option value="rendah" {{ old('potensi',$data->potensi) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    </select>
                                    @error('potensi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-9">
                                    <label for="ch" class="form-label">Tindakan <span id="required">*</span></label>
                                    <textarea type="text" class="form-control  @error('tindakan') is-invalid @enderror"
                                        name="tindakan" value="{{ old('tindakan',$data->tindakan) }}" placeholder="Masukkan Tindakan yang perlu dilakukan">{{$data->tindakan }}</textarea>
                                    @error('tindakan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a class="btn btn-outline-secondary" href="{{ route('tindakan.index') }}">Batal</a>
                                </div>
                            </div>
                        </form>
                        </div>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
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
            window.location = "/admin-panel/data-master/tindakan";
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
            window.location = "/admin-panel/data-master/tindakan";
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
