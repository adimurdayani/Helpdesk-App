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
                        <i class="fa fa-plus"></i> Ajukan Email
                    </a>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $head = [
                            'No.',
                            'No.Tiket',
                            'NIP',
                            'Nama',
                            'Jabatan',
                            'OPD',
                            'Email Usulan',
                            'No. Hp',
                            'Status',
                            'Tanggal',
                            'Aksi',
                        ];
                    @endphp

                    <x-adminlte-datatable id="email-request-table" :heads="$head" :config="['paging' => true]">
                        @foreach ($emailRequests as $item)
                            @php
                                $statusColor = match ($item->status) {
                                    'draft' => 'secondary',
                                    'diajukan' => 'warning',
                                    'diverifikasi' => 'info',
                                    'disetujui' => 'primary',
                                    'selesai' => 'success',
                                    'ditolak' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nomor_tiket }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->opd->nama_opd ?? '-' }}</td>
                                <td>{{ $item->nama_email_diusulkan . '@' . $item->domain }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center d-flex justify-content-between">
                                    @if ($item->status !== 'diverifikasi' && $item->status !== 'selesai')
                                        <a href="{{ route('email-request.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    @endif
                                    <a href="{{ route('email-request.show', $item->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                    @if (auth()->user()->hasRole('admin'))
                                        <a href="{{ route('email-request.verifikasi', $item->id) }}"
                                            class="btn btn-success btn-sm">Verifikasi</a>
                                        <form action="{{ route('email-request.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="confirm('Apakah anda yakin?')"
                                                class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
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
