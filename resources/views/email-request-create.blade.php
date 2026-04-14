@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Tambah Email Request')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Tambah Email Request')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('email-request') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="mb-3 alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-3 alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('email-request.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" placeholder="NIP"
                                class="form-control @error('nip') is-invalid @enderror">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="no_hp">No. Hp</label>
                            <input type="text" name="no_hp" placeholder="No HP"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="opd_id">OPD</label>
                            <select name="opd_id" id="opd_id"
                                class="form-control @error('opd_id') is-invalid @enderror">
                                <option value="">Pilih</option>
                                @foreach ($opd as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_opd }}</option>
                                @endforeach
                            </select>
                            @error('opd_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="nama_email_diusulkan">Nama email diusulkan</label>
                            <input type="text" name="nama_email_diusulkan" placeholder="Nama Email"
                                class="form-control @error('nama_email_diusulkan') is-invalid @enderror">

                            @error('nama_email_diusulkan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="domain">Domain</label>
                            <input type="text" name="domain" value="palopokota.go.id"
                                class="form-control @error('domain') is-invalid @enderror">
                            @error('domain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <textarea name="alasan_permohonan" class="mb-2 form-control"></textarea>

                        <input type="file" name="surat_permohonan" class="mb-2 form-control">

                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>

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
