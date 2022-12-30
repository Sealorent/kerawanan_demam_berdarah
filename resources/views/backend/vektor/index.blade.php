@extends('layouts.template')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="div d-flex justify-content-between">
                            <h5 class="card-tittle text-primary">Data Vektor {{ $month." ".$reqdate }}</h5>
                            <div class="d-flex  justify-content-end">
                                <form action="{{ route('vektor.index') }}" class="mx-2 mb-3" method="get">
                                    <div class="input-group">
                                        <input type="text" name="date" id="datetimes" class="form-control " value=""
                                            placeholder="Pilih Periode">
                                        <select id="triwulan" name="triwulan"
                                            class="select2 form-select  @error('triwulan') is-invalid @enderror">
                                            <option value="">--- Pilih triwulan ---</option>
                                            @foreach ($triwulan as $key => $val )

                                            @if ( old('triwulan') == $key)
                                            <option value="{{ $key }}" selected>{{ $val['name']
                                                }}
                                            </option>
                                            @else
                                            <option value="{{ $key }}">{{ $val['name'] }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('tahun')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <button class="input-group-text" id="search" type="submit"> <i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                                {{-- <a href="{{ route('vektor.create') }}" class="btn mb-3 mt-0 btn-primary">
                                    <span class="fa-solid fa-plus"></span>&nbsp;Tambah Data
                                </a> --}}
                            </div>
                        </div>

                        <hr class="my-0" />
                    </div>
                    <!-- Account -->
                    <div class="card-body p-0">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <th class="text-center">HI <small>%</small></th>
                                            <th class="text-center">ABJ <small>%</small></th>
                                            <th class="text-center">KASUS DBD</th>
                                            {{-- <th class="text-center">Opsi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$data->isEmpty())
                                        @foreach ($data as $item)

                                        <tr>
                                            <td><strong>{{ $item[0]['nama_kecamatan']}}</strong></td>
                                            <td class="text-center"><strong>{{ $item[0]['hi']}} </strong></td>
                                            <td class="text-center"><strong>{{ $item[0]['abj']}} </strong></td>
                                            <td class="text-center"><strong>{{ $item[0]['kasus_dbd']}}</strong></td>
                                            {{-- <td class="text-center">
                                                <a href="{{ route('vektor.edit', $item[0]['id']) }}">
                                                    <button type="button" class="btn btn-primary btn-icon">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('vektor.destroy', $item[0]['id']) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn  btn-danger btn-icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center">Data Masih Kosong</td>
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
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('extraJS')
<script type="text/javascript">
    $(function() {
        $('#datetimes').datepicker({
            autoclose: true,
            viewMode: 'years',
		     format: 'yyyy',
             minViewMode: "years",
            zIndexOffset : 999,
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
        })
</script>
@endif
@if (session('info'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Mohon Maaf',
        text: '{{ session()->get('info') }}',
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
