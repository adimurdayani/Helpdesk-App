@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Email Request')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Email Request')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('email-request.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $head =[
                            'No.',
                            'Nama',
                            'NIP',
                            'Jabatan',
                            'OPD',
                            'Email usulan',
                            'No. Hp',
                            'Status',
                            'Tanggal',
                            'Aksi',
                        ]
                    @endphp

                    <x-adminlte-datatable id="email-request-table" :heads="$head" :config="['paging' => true]">
                        @foreach ($emailRequests as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nomor_tiket }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->opd->nama_opd }}</td>
                                <td>{{ $item->nama_email_diusulkan . '@' . $item->domain }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ getStatusColor($item->status) }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-info">Detail</a>
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

@push('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@endpush
