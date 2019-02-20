@extends('layouts.main')

@section('layout')

    @include('judge.partials.sidebar')
    @yield('content')

@endsection

@push('css')
    {!! css('user/main') !!}
@endpush
