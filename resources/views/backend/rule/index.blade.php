@extends('layouts.template')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow ">
                    <div class="card-header">
                        <div class="d-flex  justify-content-between">
                            <h4 class="card-tittle text-primary">Rule</h4>
                            <a href="{{ route('rule.create') }}" class="btn  mt-0 btn-primary">
                                <span class="fa-solid fa-plus"></span>&nbsp;Tambah Data
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                </div>
                            </div> --}}
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col text-center">No</th>
                                            <th class="col text-center">Curah Hujan</th>
                                            <th class="col text-center">Hari Hujan</th>
                                            <th class="col text-center">ABJ</th>
                                            <th class="col text-center">Suhu</th>
                                            <th class="col text-center">Kelembaban</th>
                                            <th class="col text-center">Potensi</th>
                                            {{-- <th class="col align-middle text-center">Opsi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$data->isEmpty())
                                        @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center"><strong> {{($data->currentPage() - 1) *
                                                    $data->perPage() + $loop->iteration}}</strong></td>
                                            <td class="text-center">{{ ucwords($item->ch) }}</td>
                                            <td class="text-center">{{ ucwords($item->hh) }}</td>
                                            <td class="text-center">{{ ucwords($item->abj) }}</td>
                                            <td class="text-center">{{ ucwords($item->suhu) }}</td>
                                            <td class="text-center">{{ ucwords($item->kelembaban) }}</td>
                                            <td class="text-center">{{ ucwords($item->potensi) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('rule.edit', $item->id) }}">
                                                    <button type="button" class="btn btn-primary btn-icon">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('rule.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn  btn-danger btn-icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </td>
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
        })
    </script>
    @endif
    @if (session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Mohon Maaf',
            text: '{{ session()->get('info') }}',
            type: "info"
        })
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: '{{ session()->get('error') }}',
            type: "error"
        })
    </script>
    @endif
    @endpush
