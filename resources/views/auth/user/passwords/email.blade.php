@extends('layouts.auth')

@section('form')

@include('auth.general.passwords.email', ['formAction' => route('user.password.email')]);

@stop
