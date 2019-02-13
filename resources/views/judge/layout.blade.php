@extends('layouts.main')

@section('layout')

    @include('user.partials.sidebar')
    @yield('content')

@endsection

@push('css')
    {!! css('user/main') !!}
@endpush
