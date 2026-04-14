@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Detail Permintaan Email')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Detail Permintaan Email')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('email-request') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- STATUS --}}
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

                    <div class="mb-3">
                        <span class="badge bg-{{ $statusColor }}">
                            {{ ucfirst($emailRequest->status) }}
                        </span>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nomor Tiket</th>
                                    <td>{{ $emailRequest->nomor_tiket }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
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
                                    <th>No HP</th>
                                    <td>{{ $emailRequest->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Email Pribadi</th>
                                    <td>{{ $emailRequest->email_pribadi ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>OPD</th>
                                    <td>{{ $emailRequest->opd->nama_opd ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email Usulan</th>
                                    <td>
                                        {{ $emailRequest->nama_email_diusulkan . '@' . $emailRequest->domain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Diproses Oleh</th>
                                    <td>{{ $emailRequest->diprosesOleh->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Verifikasi</th>
                                    <td>{{ $emailRequest->tanggal_verifikasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>{{ $emailRequest->tanggal_selesai ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $emailRequest->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div class="mt-3">
                        <h6>Alasan Permohonan</h6>
                        <p>{{ $emailRequest->alasan_permohonan }}</p>
                    </div>

                    <div class="mt-3">
                        <h6>Catatan Admin</h6>
                        <p>{{ $emailRequest->catatan_admin ?? '-' }}</p>
                    </div>

                    <div class="mt-3">
                        <h6>Surat Permohonan</h6>
                        @if ($emailRequest->surat_permohonan)
                            <a href="{{ asset('storage/' . $emailRequest->surat_permohonan) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                Lihat File
                            </a>
                        @else
                            <span>-</span>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    @if ($emailRequest->status !== 'selesai')
                        <form action="{{ route('email-request.updateStatus', $emailRequest->id) }}" method="post">
                            @csrf
                            @method('put')
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="diverifikasi">Diverifikasi</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <div class="form-group">
                                <label for="catatan_admin">Catatan</label>
                                <textarea name="catatan_admin" id="catatan_admin" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
@stop
