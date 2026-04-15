@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Lacak Tiket')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Lacak Tiket')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Lacak Tiket</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('lacak') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Input Nomor Tiket Anda</label>
                            </div>
                            <div class="col-md-8">
                                <input type="search" name="nomor_tiket" id="nomor_tiket"
                                    class="form-control @error('nomor_tiket') is-invalid @enderror" placeholder="#REQ-xxxx">
                                @error('nomor_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-4 d-flex justify-content-beetwen">
                                    <button type="submit" class="mr-2 btn btn-primary">Lacak</button>
                                    <a href="{{ route('lacak') }}" class="btn btn-danger">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if (session('error'))
                        <div class="mb-3 alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (!$emailRequest)
                        <div class="mt-3 mb-3 text-center alert alert-warning">
                            Nomor tiket tidak ditemukan
                        </div>
                    @else
                        @php
                            $statusColor = match ($emailRequest->status) {
                                'draft' => 'secondary',
                                'diajukan' => 'warning',
                                'diverifikasi' => 'info',
                                'disetujui' => 'primary',
                                'selesai' => 'success',
                                'ditolak' => 'danger',
                                default => 'secondary',
                            };
                        @endphp

                        <div class="shadow-sm card">
                            <div class="card-header d-flex justify-content-between">
                                <h5>Detail Tiket: {{ $emailRequest->nomor_tiket }}</h5>
                            </div>

                            <div class="card-body">

                                {{-- STATUS --}}
                                <div class="mb-3 text-center">
                                    <span class="badge bg-{{ $statusColor }} p-2">
                                        {{ strtoupper($emailRequest->status) }}
                                    </span>
                                </div>

                                {{-- PROGRESS --}}
                                <div class="mb-4 progress" style="height: 20px;">
                                    @php
                                        $progress = match ($emailRequest->status) {
                                            'draft' => 10,
                                            'diajukan' => 30,
                                            'diverifikasi' => 60,
                                            'disetujui' => 80,
                                            'selesai' => 100,
                                            'ditolak' => 100,
                                            default => 0,
                                        };
                                    @endphp
                                    <div class="progress-bar bg-{{ $statusColor }}" style="width: {{ $progress }}%">
                                        {{ $progress }}%
                                    </div>
                                </div>

                                {{-- DATA --}}
                                <div class="row">

                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nama</th>
                                                <td>{{ $emailRequest->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIP</th>
                                                <td>{{ $emailRequest->nip }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jabatan</th>
                                                <td>{{ $emailRequest->jabatan }}</td>
                                            </tr>
                                            <tr>
                                                <th>OPD</th>
                                                <td>{{ $emailRequest->opd->nama_opd ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Email Usulan</th>
                                                <td>{{ $emailRequest->nama_email_diusulkan . '@' . $emailRequest->domain }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ ucfirst($emailRequest->status) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dibuat</th>
                                                <td>{{ $emailRequest->created_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                                {{-- TIMELINE --}}
                                <div class="mt-4">
                                    <h6>Timeline Proses</h6>
                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            ✅ Permintaan dibuat ({{ $emailRequest->created_at->format('d M Y H:i') }})
                                        </li>

                                        @if ($emailRequest->tanggal_verifikasi)
                                            <li class="list-group-item">
                                                🔍 Diverifikasi ({{ $emailRequest->tanggal_verifikasi }})
                                            </li>
                                        @endif

                                        @if ($emailRequest->tanggal_selesai)
                                            <li class="list-group-item">
                                                🎉 Selesai ({{ $emailRequest->tanggal_selesai }})
                                            </li>
                                        @endif

                                        @if ($emailRequest->status === 'ditolak')
                                            <li class="list-group-item text-danger">
                                                ❌ Ditolak - {{ $emailRequest->catatan_admin }}
                                            </li>
                                        @endif

                                    </ul>
                                </div>

                            </div>
                        </div>

                    @endif

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
@endpush
