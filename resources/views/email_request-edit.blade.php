@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Edit Email Request')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Edit Email Request')

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

                    <form action="{{ route('email-request.update', $emailRequest->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="mb-2 form-control"
                            value="{{ $emailRequest->nama_lengkap }}">
                        <input type="text" name="nip" placeholder="NIP" class="mb-2 form-control"
                            value="{{ $emailRequest->nip }}">
                        <input type="text" name="jabatan" placeholder="Jabatan" class="mb-2 form-control"
                            value="{{ $emailRequest->jabatan }}">
                        <input type="text" name="no_hp" placeholder="No HP" class="mb-2 form-control"
                            value="{{ $emailRequest->no_hp }}">
                        <div class="form-group">
                            <select name="opd_id" id="opd_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($opd as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $emailRequest->opd_id == $item->id ? 'selected' : '' }}>{{ $item->nama_opd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" name="nama_email_diusulkan" placeholder="Nama Email" class="mb-2 form-control"
                            value="{{ $emailRequest->nama_email_diusulkan }}">
                        <input type="text" name="domain" value="palopokota.go.id" value="{{ $emailRequest->domain }}"
                            class="mb-2 form-control">

                        <textarea name="alasan_permohonan" class="mb-2 form-control">{{ $emailRequest->alasan_permohonan }}</textarea>

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
