@extends('layouts.auth')

@section('form')

@include('auth.general.passwords.email', ['formAction' => route('admin.password.email')]);

@stop
