@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Role')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Role')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('role.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <x-adminlte-datatable id="role-table" :heads="['NO.', 'Nama', 'Guard', 'Aksi']" :config="['paging' => true]">
                        @foreach ($roles as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->guard_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('role.edit', $item->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('role.destroy', $item->id) }}" method="post"
                                            class="inline-flex">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="confirm('Apakah anda yakin?')"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>

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
@section('plugins.Datatables', true)
@push('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@endpush
