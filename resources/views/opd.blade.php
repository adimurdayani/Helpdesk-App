@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'OPD')
@section('content_header_title', 'Dashboard')
@section('content_header_subtitle', 'Perangkat Daerah')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('opd.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode OPD</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_opd }}</td>
                                        <td>{{ $item->nama_opd }}</td>
                                        <td>{{ $item->is_active }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@endpush
