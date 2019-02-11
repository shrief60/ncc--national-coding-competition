@extends('layouts.auth')

@section('form')


@include('auth.general.register', [
    'formAction' => route('judge.register'),
])

@stop
