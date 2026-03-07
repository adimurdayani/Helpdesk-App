@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Tambah Data')
@section('content_header_title', 'OPD')
@section('content_header_subtitle', 'Tambah Data Perangkat Daerah')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('opd') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('opd.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="kode_opd">Kode OPD</label>
                            <input type="text" name="kode_opd" id="kode_opd"
                                class="form-control @error('kode_opd') is-invalid @enderror" value="{{ old('kode_opd') }}"
                                placeholder="Masukkan kode OPD">
                            @error('kode_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_opd">Nama OPD</label>
                            <input type="text" name="nama_opd" id="nama_opd"
                                class="form-control @error('nama_opd') is-invalid @enderror" value="{{ old('nama_opd') }}"
                                placeholder="Masukkan kode OPD">
                            @error('nama_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active"
                                class="form-control @error('is_active') is-invalid @enderror">
                                <option value="">Pilih status</option>
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-close"></i> Reset</button>
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
