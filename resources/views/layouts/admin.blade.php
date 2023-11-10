@extends('adminlte::page')
@section('title', 'admin')
@section('content_header')
    <h1>{{ $title ?? 'Senakitcht' }}</h1>
@stop
@section('content')
    {{ $slot }}
@stop
@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@stop

@section('js')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop


