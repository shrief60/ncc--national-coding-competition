@extends('layouts.auth')

@section('form')


@include('auth.general.register', [
    'formAction' => route('user.register'),
])

@stop
