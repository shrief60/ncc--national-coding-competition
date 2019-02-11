@extends('layouts.auth')
@section('form')

@include('auth.general.login', [
    'formAction' => route('admin.login'),
    'forgetPassword' => route('admin.password.reset')
])
@stop
