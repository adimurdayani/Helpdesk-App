@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Role')
@section('content_header_title', 'Beranda')
@section('content_header_subtitle', 'Role')

{{-- Content body: main page content --}}

@section('content_body')
    <p>Welcome to this role.</p>
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
