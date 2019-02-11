@extends('layouts.auth')

@section('form')

@include('auth.general.passwords.reset', ['formAction' => route('user.password.reset')])

@stop
